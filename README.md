---
# 🎟️ EvenSys - Sistema de Gestão de Eventos
## 📖 Sobre o Projeto

O **EvenSys** é um sistema web de gestão de eventos e venda de ingressos construído com arquitetura MVC em PHP puro. Este é um projeto acadêmico desenvolvido para consolidar conceitos de Engenharia de Software, modelagem de dados e segurança de aplicações (autenticação, sessões e proteção contra injeções SQL), juntamente com o uso de IA.

## 🎓 Informações Acadêmicas

Este projeto foi desenvolvido com a finalidade de consolidar os conhecimentos teóricos e práticos adquiridos ao longo da graduação.

---

* **Autor:** Isack Phelipe (*Graduando em Engenharia de Software*)
* **Instituição:** UNICEPLAC (Centro Universitário do Planalto Central Apparecido dos Santos)
* **Orientação Acadêmica:** Prof. Hudson Neves
* **Contexto:** Disciplina de Programação Orientada a Software Básico — ENGSOFT6AM

## 🤖 Transparência e Desenvolvimento Estratégico

Para lidar com esse cenário de forma pragmática, **utilizei ferramentas de IA para agilizar a entrega** e orientar a estruturação do código. No entanto, todo o desenvolvimento foi feito com muito cuidado, zelo e revisão técnica. Embora a IA seja uma excelente aliada, na prática, ela muitas vezes mais atrapalha do que ajuda se não houver um desenvolvedor no comando para garantir o desacoplamento, a lógica de negócios e a coerência da arquitetura.

Este repositório é o resultado de uma engenharia guiada, mas supervisionada e auditada com rigor.

## ⚙️ Funcionalidades

* **Autenticação e Controle de Acesso:** Sistema de login e cadastro com hash seguro de senhas e divisão de privilégios (Organizadores e Participantes).
* **Painel do Organizador:** Área restrita para cadastro de categorias, criação de eventos e gestão de lotes de ingressos.
* **Vitrine Pública:** Interface onde participantes podem visualizar eventos ativos e consultar informações de data, local e capacidade.
* **Motor de Vendas (Simulado):** Fluxo de checkout com baixa automática de estoque, respeitando regras de concorrência e capacidade de lotes.
* **Emissão de Ingressos:** Geração de bilhetes virtuais com código único criptografado (Hash) para validação segura na entrada do evento.

## 🛠️ Tecnologias e Padrões

* **Linguagem:** PHP 8+
* **Banco de Dados:** MySQL (comunicação via driver PDO)
* **Arquitetura:** MVC (Model-View-Controller) customizado com padrão *Front Controller*
* **Interface:** HTML5, CSS3 (Flexbox e Grid) focado em responsividade
* **Gerenciamento de Dependências:** Composer (para carregamento de variáveis de ambiente com `vlucas/phpdotenv`)

## 🚀 Como Executar o Projeto Localmente

### 1. Requisitos

* PHP 8.0 ou superior
* Composer instalado
* Servidor MySQL (XAMPP ou via container)

### 2. Configuração do Ambiente

Clone o repositório para a sua máquina:

```bash
git clone https://github.com/seu-usuario/evensys.git
cd evensys

```

Instale as dependências do Composer:

```bash
composer install

```

### 3. Banco de Dados

* Crie um banco de dados no seu MySQL chamado `evensys`.
* Importe o arquivo `.sql` localizado na pasta `database/` para recriar as tabelas.
* Crie um arquivo `.env` na raiz do projeto com base no seu ambiente local:

```env
DB_HOST=127.0.0.1 // ou localhost
DB_NAME=evensys
DB_USER=root
DB_PASS=

```

### 4. Iniciando o Servidor

Você pode rodar a aplicação utilizando o servidor embutido do próprio PHP. No terminal, execute:

```bash
php -S localhost:8000 -t public

```

Acesse a aplicação no seu navegador através do endereço `http://localhost:8000`.

---

*Desenvolvido como requisito acadêmico, com foco em entrega ágil e padrões de projetos.*
