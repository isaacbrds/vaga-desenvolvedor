<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sistema de Gerenciamento de Usuários

Sistema para cadastro e gerenciamento de usuários com autenticação segura e validação de dados.

## Recursos
- Cadastro de usuários
- Validação de dados com feedback personalizado

## Requisitos
- PHP 8.2
- Laravel 11.31
- Composer
- Sqlite

## Instalação
```bash
git clone https://github.com/isaacbrds/vaga-desenvolvedor.git
cd vaga-desenvolvedor
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Configuração
Edite o arquivo .env com suas configurações de banco de dados e email.

## Estrutura de Validação
O sistema utiliza Form Requests para validação de dados:
- Validação de email e unicidade
- Regras de complexidade para senhas
- Feedback em português para melhor UX


## Licença
MIT
