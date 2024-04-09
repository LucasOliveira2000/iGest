<!DOCTYPE html>
<html>
<head>
    <title>Novo Contato</title>
</head>
<body>
    <p>Um novo contato foi enviado:</p>
    <p><strong>Nome:</strong> {{ $contact->nome }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Telefone:</strong> {{ $contact->telefone }}</p>
    <p><strong>Dúvida:</strong> {{ $contact->mensagem }}</p>
</body>
</html>