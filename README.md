# API Laravel 10 + MySQL

## 📋 Descrição

API desenvolvida em Laravel 10 utilizando Eloquent ORM, MySQL como banco de dados e Docker para facilitar o ambiente de desenvolvimento.

---

## 🔧 Requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Git](https://git-scm.com/)

---

## 🚀 Instalação e Uso

1. **Clone o repositório**

   ```bash
   git clone https://github.com/ribeirosacarlos/ts-backend.git
   cd ts-backend
   ```

2. **Configure as variáveis de ambiente**

   ```bash
   cp .env.example .env
   ```

   > Edite o arquivo `.env` se necessário, mas as credenciais padrão já funcionam para o ambiente local.

3. **Suba os containers**

   ```bash
   docker-compose up -d
   ```

4. **Instale as dependências do Laravel**

   ```bash
   docker exec -it laravel_app composer install
   ```

5. **Gere a chave da aplicação**

   ```bash
   docker exec -it laravel_app php artisan key:generate
   ```

6. **Atualize o schema do banco de dados via migrate**

   ```bash
   docker exec -it laravel_app php artisan migrate
   ```

---

## 🗄️ Banco de Dados

- O banco de dados PostgreSQL é inicializado automaticamente via Docker.
- As credenciais e configurações estão no arquivo `.env.example`.

