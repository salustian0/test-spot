# Teste Spot

Desenvolvido por Renan Salustiano

## Instruções:

1. Ter o PHP 8.1 instalado.
2. Executar o comando `composer install`.
3. No arquivo `.env`, configurar as credenciais de acesso ao banco.
4. Criar o banco com o mesmo nome configurado nas credenciais do passo anterior.
5. Executar o comando `php artisan migrate`.
6. Executar o comando `php artisan serve`.

**Observação:** Qualquer problema encontrado ao seguir este guia pode estar relacionado à versão do PHP ou à configuração do banco de dados.

É possível gerar dados fictícios para testar a aplicação com o comando:

```bash
php artisan db:seed
