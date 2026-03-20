# 🚀 DeuRuim — Sistema de Gestão de Chamados Técnicos

<p align="center">
  Sistema web desenvolvido com Laravel para gerenciamento completo de chamados técnicos, com controle de SLA, prioridades e fluxo de atendimento.
</p>

---

## 📖 Descrição do Projeto

O **DeuRuim** é um sistema web criado para gerenciar chamados técnicos de forma organizada, permitindo acompanhar o ciclo completo de atendimento — desde a abertura até o fechamento.

O sistema foi desenvolvido como parte de um projeto prático, atendendo requisitos de modelagem, regras de negócio e funcionalidades obrigatórias.

---

## 🎯 Objetivo

Desenvolver um sistema que permita:

- Gerenciar chamados técnicos
- Controlar prioridades e status
- Acompanhar prazos (SLA)
- Organizar atendimentos por técnicos e categorias

---

## 🧠 Requisitos do Projeto

Baseado no enunciado do trabalho:

- CRUD completo para todas as entidades
- Relacionamentos entre entidades
- Filtros por prioridade e status
- Ordenação automática de chamados
- Destaque visual por prioridade
- Controle de SLA (chamados atrasados)

---

## 🧱 Modelagem do Sistema

### 📋 Chamado
Representa uma solicitação de suporte técnico.

**Campos:**
- id
- titulo
- descricao
- prioridade (baixa, média, alta)
- status (aberto, em_atendimento, resolvido, fechado)
- data_abertura
- tecnico_id (FK)
- categoria_id (FK)

---

### 🧑‍🔧 Técnico
Responsável pelo atendimento dos chamados.

**Campos:**
- id
- nome
- email
- especialidade

---

### 🏷️ Categoria
Define o tipo de problema.

**Campos:**
- id
- nome
- sla_horas (tempo estimado de atendimento)

---

## ⚙️ Funcionalidades

### 📌 Chamados
- Cadastro de chamados
- Edição e atualização
- Listagem com filtros
- Ordenação por prioridade
- Identificação de chamados atrasados

### 🧑‍🔧 Técnicos
- Cadastro de técnicos
- Associação com chamados

### 🏷️ Categorias
- Cadastro de categorias
- Definição de SLA

---

## 📏 Regras de Negócio

- Um chamado **só pode ser fechado se estiver resolvido**
- Chamados com SLA excedido devem ser sinalizados
- Filtros por prioridade e status na listagem
- Chamados de **alta prioridade aparecem primeiro**

---

## 🛠️ Tecnologias Utilizadas

- PHP 8.x
- Laravel 12
- MySQL
- Docker / Docker Compose
- Blade
- Composer

---

## 🐳 Ambiente com Docker

### 🔧 Subindo o projeto

```bash
git clone <url-do-repositorio>
cd DeuRuim-ProjetoPratico1

docker compose up -d
docker compose exec app bash

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

---

## 🌐 Acesso

- Aplicação: http://localhost:8080/chamados

---

## 📌 Estrutura do Projeto

```bash
src/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
├── database/
├── resources/views/
├── routes/
├── config/
└── artisan
```

---


## 👨‍💻 Autores

- Jhannyfer Sweyvezes Rodrigues Biangulo  
- Rafael de Souza Teixeira  

---
