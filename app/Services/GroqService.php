<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    // Funzione semplicissima per controllare se un testo va bene
    public function moderate($text)
    {
        // Prepariamo la domanda per l'Intelligenza Artificiale
        $prompt = "Sei un moderatore di un forum. Devi controllare se il seguente testo rispetta la netiquette. 
        Regole:
        1. Niente insulti, parolacce o volgarità.
        2. Niente discriminazioni, razzismo, ecc.
        3. Niente spam o minacce.
        
        Rispondi SOLO con 'OK' se il testo va bene, oppure 'BLOCCATO' se viola le regole. Non aggiungere altre parole.
        
        Testo da controllare: " . $text;

        $apiKey = config('groq.api_key');

        // Facciamo la richiesta a Groq (Llama 3.3 70B)
        $response = Http::withToken($apiKey)->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0, // Vogliamo risposte precise, non creative
        ]);

        // Se c'è un errore di connessione, per sicurezza lasciamo passare (o possiamo bloccare)
        if ($response->failed()) {
            return true; 
        }

        // Leggiamo la risposta dell'AI
        $result = $response->json('choices.0.message.content');
        
        // Se la risposta contiene BLOCCATO, allora non va bene
        if (str_contains(strtoupper($result), 'BLOCCATO')) {
            return false;
        }

        return true;
    }

    // Funzione per trovare i post in base al significato (Ricerca Semantica)
    public function semanticSearch($query, $posts)
    {
        // Se non ci sono post, non cerchiamo nulla
        if ($posts->isEmpty()) {
            return [];
        }

        // Creiamo una lista di post da mostrare all'AI
        $postsText = "";
        foreach ($posts as $post) {
            $postsText .= "ID: {$post->id} | Titolo: {$post->title} | Contenuto: {$post->content}\n";
        }

        $prompt = "Sei un motore di ricerca intelligente. L'utente sta cercando qualcosa in base al significato.
        Ecco cosa cerca l'utente: '{$query}'
        
        Ecco la lista dei post disponibili:
        {$postsText}
        
        Trova i post che corrispondono al significato della ricerca dell'utente.
        Rispondi SOLO con una lista di ID dei post separati da virgola (esempio: 1,4,5).
        Se nessun post c'entra nulla, rispondi SOLO con la parola 'NESSUNO'.";

        $apiKey = config('groq.api_key');

        // Facciamo la richiesta
        $response = Http::withToken($apiKey)->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.2, // Un po' di flessibilità ma non troppa
        ]);

        if ($response->failed()) {
            return [];
        }

        $result = $response->json('choices.0.message.content');

        // Se ha risposto NESSUNO, restituiamo un array vuoto
        if (str_contains(strtoupper($result), 'NESSUNO')) {
            return [];
        }

        // Dividiamo la risposta (es: "1,4,5") in un array di numeri
        $ids = explode(',', $result);
        
        // Puliamo gli ID da spazi vuoti
        $cleanIds = [];
        foreach ($ids as $id) {
            $id = trim($id);
            if (is_numeric($id)) {
                $cleanIds[] = (int)$id;
            }
        }

        return $cleanIds;
    }
}
