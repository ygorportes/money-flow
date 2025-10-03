# MoneyFlow 💸

Um gerenciador de finanças pessoais simples para controle de receitas e despesas, construído com Laravel e FilamentPHP.

## Tecnologias Utilizadas

* **Framework Backend:** Laravel 12
* **Painel de Admin:** FilamentPHP 4
* **Autenticação Social:** Laravel Socialite
* **Banco de Dados:** MySQL
* **Linguagem:** PHP 8.4

## Como Começar (Ambiente de Desenvolvimento)

Siga os passos abaixo para rodar o projeto localmente.

1.  **Clonar o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/money-flow.git](https://github.com/seu-usuario/money-flow.git)
    cd money-flow
    ```

2.  **Instalar as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Configurar o ambiente:**
    Copie o arquivo de exemplo `.env.example` para um novo arquivo `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Gerar a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

5.  **Configurar o banco de dados MySQL:**
    * Crie um novo banco de dados no seu servidor MySQL (ex: `money_flow`).
    * Atualize as seguintes variáveis no seu arquivo `.env` com as suas credenciais do MySQL:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=money_flow
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Rodar as migrations:**
    Este comando criará todas as tabelas no banco de dados.
    ```bash
    php artisan migrate
    ```

7.  **Criar um usuário administrador:**
    Para acessar o painel, crie um usuário. O comando pedirá seu nome, e-mail e senha.
    ```bash
    php artisan make:filament-user
    ```

8.  **Iniciar o servidor:**
    ```bash
    php artisan serve
    ```

Acesse [http://1227.0.0.1:8000/admin](http://127.0.0.1:8000/admin) no seu navegador e faça o login com o usuário que você criou.
