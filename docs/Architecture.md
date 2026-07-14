# CM Performance Suite

# Enterprise Architecture

Versione: 1.1.0-alpha.3

---

# Filosofia

La CM Performance Suite è progettata come una piattaforma enterprise modulare.

Ogni modulo deve essere indipendente, riutilizzabile e facilmente estendibile.

L'obiettivo è evitare codice duplicato e separare chiaramente responsabilità e livelli dell'applicazione.

---

# Architettura

```
                Dashboard
                     │
                     ▼
            Performance Service
                     │
                     ▼
           Performance Engine
                     │
     ┌───────────────┼───────────────┐
     ▼               ▼               ▼
 Collectors      Analyzers     Recommendations
     │               │
     └───────┬───────┘
             ▼
     Analysis_Result
             │
             ▼
          Widgets
             │
             ▼
            Views
```

---

# Componenti

## Collectors

Responsabilità:

- raccolta dati
- nessuna logica
- nessuna interpretazione

Esempi:

- PHP
- WordPress
- Database
- Server
- WooCommerce

---

## Analyzers

Responsabilità:

- analizzare i dati raccolti
- assegnare un punteggio
- determinare lo stato
- produrre un risultato standard

Output:

Analysis_Result

---

## DTO

Contiene gli oggetti condivisi.

Attualmente:

- Analysis_Result

---

## Engine

Coordina l'intero processo.

Responsabilità:

- eseguire gli Analyzer
- raccogliere i risultati
- calcolare lo stato complessivo
- fornire i dati ai Widget

---

## Recommendations

Genera consigli operativi.

Esempio:

- aggiornare PHP
- aumentare memory_limit
- abilitare OPcache
- eliminare revisioni

---

## Widgets

Visualizzano i risultati.

Non devono contenere logica di business.

---

## Views

Responsabilità:

- rendering HTML
- utilizzo dei Widget
- nessuna logica applicativa

---

# Flusso di esecuzione

Collector

↓

Analyzer

↓

Analysis_Result

↓

Performance Engine

↓

Widget

↓

View

---

# Principi

- Single Responsibility Principle
- Dependency Injection
- Composition over Inheritance
- Typed Objects
- Nessuna logica nelle View
- Nessuna logica nei Collector
- Tutti gli Analyzer restituiscono Analysis_Result
- Tutti gli stati utilizzano Status enum

---

# Obiettivo

Ogni futuro modulo della Suite (Database, Cache, Security, WooCommerce, SEO, Logs...) dovrà seguire questa stessa architettura.