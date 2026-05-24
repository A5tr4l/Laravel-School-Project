# 🗨️ Laravel Social Demo – Topic & Discussion Platform

## 📌 Descrizione

Questo progetto è una semplice piattaforma social sviluppata con **Laravel** che permette agli utenti registrati di partecipare a discussioni giornaliere tramite post e commenti.

L’obiettivo del progetto è simulare una mini rete sociale con gestione utenti, topic giornalieri e interazioni tra utenti.

---

## 🚀 Funzionalità principali

### 🔐 Autenticazione utenti
- Registrazione nuovi utenti
- Login / Logout
- Protezione delle rotte (accesso solo utenti autenticati)

---

### 📌 Topic giornalieri (Admin)
- Creazione di un topic del giorno
- Solo gli **admin** possono creare nuovi topic
- Ogni topic rappresenta una discussione principale

---

### 📝 Post degli utenti
- Gli utenti possono scrivere post all’interno del topic attivo
- Ogni post è associato all’utente che lo ha creato
- I post sono visibili a tutti gli utenti autenticati

---

### 💬 Commenti
- Gli utenti possono commentare i singoli post
- Sistema di discussione nidificata (post → commenti)

---

### 📜 Storico topic
- Sezione dedicata ai topic precedenti
- Visualizzazione di tutti i topic creati nel tempo
- Accesso ai relativi post associati

---

### 🛡️ Sistema admin
- Gli admin hanno privilegi speciali
- Possono creare nuovi topic giornalieri
- Controllo separato rispetto agli utenti normali

---

## 🏗️ Architettura (MVC Laravel)

Il progetto segue il pattern **MVC**:

- **Model** → gestione dati (User, Topic, Post, Comment)
- **View** → interfaccia utente (Blade templates)
- **Controller** → logica applicativa (TopicController, PostController, CommentController)

---

## 🗄️ Database

Tabelle principali:

- `users` → utenti registrati
- `topics` → topic giornalieri
- `posts` → post degli utenti
- `comments` → commenti ai post

Relazioni:
- User → hasMany Posts / Comments
- Topic → hasMany Posts
- Post → hasMany Comments

---

## ⚙️ Tecnologie utilizzate

- Laravel 13
- PHP 8.3
- MySQL
- Docker (ambiente di sviluppo)
- Blade templating
- CSS personalizzato
