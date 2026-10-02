# Lista de Exercicos - CRUD

## Parte A: Exercícios Teóricos de Fixação

1. **Definição de CRUD:** O que significa o acrônimo CRUD e qual é a correspondência direta de cada uma de suas letras com as instruções SQL no PostgreSQL?
R.  CRUD significa **Create, Read, Update e Delete**. No SQL, eles correspondem respectivamente a **INSERT** (criar), **SELECT** (ler/buscar), **UPDATE** (alterar) e **DELETE** (excluir).

2. **Anatomia do SQL Injection:** Explique com suas próprias palavras como um atacante consegue alterar a lógica de uma consulta quando o código utiliza concatenação de strings com `$_GET` ou `$_POST`.
R. O SQL Injection acontece quando o sistema pega um valor enviado pelo usuário, como por `$_GET` ou `$_POST`, e coloca diretamente dentro de uma consulta SQL usando concatenação. O problema é que o usuário pode digitar algo que altere a estrutura da consulta. Dessa forma, o banco pode interpretar o que foi digitado como parte do comando SQL, e não apenas como um dado.


3. **Mecanismo das Prepared Statements:** Por que o envio de uma consulta em duas etapas (`prepare` e depois `execute`) impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco?

R.As Prepared Statements separam a estrutura da consulta dos dados enviados pelo usuário. Primeiro o banco recebe a consulta com prepare() e depois recebe os valores com execute() ou bindValue(). Assim, o texto informado pelo usuário é tratado como dado e não como parte do comando SQL.


4. **Marcadores Nomeados:** Qual é a vantagem de utilizar marcadores nomeados como `:sku` e `:preco` em vez de pontos de interrogação posicionais (`?`) em instruções SQL complexas?
> A principal vantagem de utilizar marcadores nomeados (como :sku e :preco) em vez de pontos de interrogação (?) é a legibilidade e a facilidade de manutenção do código, e tambem evita a troca de valores evitando erros especialmente em instruções SQL complexas.

5. **Diferença entre Bindings:** Explique a diferença de comportamento entre os métodos `$stmt->bindValue()` e `$stmt->bindParam()`.

R. `bindValue` prende o valor atual de uma variável ao parâmetro. Já `bindParam` prende o parâmetro à variável, então o valor da variável pode ser alterado antes do `execute`, e o novo valor será usado. Para situações simples, `bindValue` costuma ser mais fácil de entender.



6. **Tipagem no PDO:** Qual é o risco de omitir o tipo de dado (ex: `PDO::PARAM_INT`) ao vincular uma variável que deveria ser estritamente numérica em uma cláusula `LIMIT`?

## 6. Tipagem no PDO

Por padrão, o PDO trata o valor vinculado como string (`PDO::PARAM_STR`). Em uma cláusula `LIMIT`, que espera um inteiro, omitir `PDO::PARAM_INT` traz riscos:

- Em alguns drivers/configurações (principalmente com *emulated prepares*), o valor é enviado entre aspas (`LIMIT '10'`), o que gera **erro de sintaxe** ou comportamento inconsistente.
- O código passa a depender de conversões implícitas do banco, que variam entre SGBDs e versões, deixando o comportamento imprevisível.
- Se um valor não numérico chegar (por exemplo, vindo da URL), o erro só aparece em tempo de execução, em vez de ser tratado antes.
- Deixa de ficar explícita a intenção do código: "este valor é estritamente um número".

Por isso a boa prática é tipar e, de preferência, converter antes:

```php
$stmt->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
```


7. **Padrão DAO:** Qual é o benefício do padrão *Data Access Object* (DAO) em termos de manutenibilidade de software e do princípio de responsabilidade única (SOLID)?
R> O DAO (Data Access Object) separa as operações relacionadas ao banco de dados do restante da aplicação.

Isso facilita a organização e manutenção do código e segue o princípio da Responsabilidade Única (SRP) do `SOLID`.

Exemplo:

```php
class ProdutoDAO
{
    public function buscarTodos($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM produtos");

        return $stmt->fetchAll();
    }
}
```

*Nesse exemplo, o DAO fica responsável pelas operações relacionadas aos dados dos produtos.* 


8. **Operações de Update:** Por que a ausência de uma cláusula `WHERE` em um comando `UPDATE` é considerada um incidente gravíssimo em ambientes de produção?

> Um UPDATE sem WHERE pode alterar todos os registros da tabela de uma vez. Em um sistema de produção, isso pode causar uma grande perda ou alteração de dados. Por isso, é muito importante verificar a condição antes de executar o comando.



9. **Impacto da LGPD:** De acordo com a Lei Geral de Proteção de Dados (LGPD), quais são as penalidades e impactos que uma organização pode sofrer caso ocorra vazamento de dados de clientes por falha de SQL Injection?

Se acontecer um vazamento de dados por uma falha de segurança, a empresa pode sofrer consequências previstas na LGPD. Dependendo do caso, a ANPD pode aplicar **advertência, multa simples ou diária, publicização da infração, bloqueio ou eliminação de dados**, além de outras sanções previstas na lei. A multa simples pode chegar a **2% do faturamento**, limitada a **R$ 50 milhões por infração**.

Além disso, quando o incidente puder causar risco ou dano relevante, o controlador deve comunicar a ANPD e os titulares afetados.
