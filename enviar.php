<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dados do Formulário</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .Form {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.Form label {
    font-weight: 600;
}

.Form input,
.Form textarea {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-family: inherit;
    font-size: 1rem;
}

.Form button {
    background-color: #CDA349;
    color: #fff;
    border: none;
    padding: 12px;
    font-size: 1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s ease;
}

.Form button:hover {
    background-color: #b88f36;
}
</style>
<body>

<?php
// Função para exibir o formulário de edição
function exibirFormularioEdicao($nome, $email, $mensagem) {
    echo '<h2>Editar Informações:</h2>';
    echo '<form method="POST" class="Form">';
    echo '<input type="hidden" name="editar" value="1">';
    echo '<input type="hidden" name="salvando" value="1">';

    echo '<label for="nome">Nome:</label>';
    echo '<input type="text" id="nome" name="nome" value="' . htmlspecialchars($nome) . '" required><br>';

    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" value="' . htmlspecialchars($email) . '" required><br>';

    echo '<label for="mensagem">Qual sua proposta de projeto:</label><br>';
    echo '<textarea id="mensagem" name="mensagem" rows="5" required>' . htmlspecialchars($mensagem) . '</textarea><br>';

    echo '<button type="submit">Salvar Alterações</button>';
    echo '</form>';
}

// Função para exibir os dados
function exibirDados($nome, $email, $mensagem) {
    echo "<h2>Dados recebidos:</h2>";
    echo "<p><strong>Nome:</strong> $nome</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Qual sua proposta de projeto:</strong><br>$mensagem</p>";
}

// Função para exibir o botão Editar
function exibirBotaoEditar($nome, $email, $mensagem) {
    echo '<form method="POST" class="Form"';
    echo '<input type="hidden" name="nome" value="' . htmlspecialchars($nome) . '">';
    echo '<input type="hidden" name="email" value="' . htmlspecialchars($email) . '">';
    echo '<input type="hidden" name="mensagem" value="' . htmlspecialchars($mensagem) . '">';
    echo '<input type="hidden" name="editar" value="1">';
    echo '<button type="submit">Editar</button>';
    echo '</form>';
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    // Se está editando e clicou em salvar
    if (isset($_POST['editar']) && isset($_POST['salvando'])) {
        exibirDados($nome, $email, $mensagem);
        exibirBotaoEditar($nome, $email, $mensagem);
    }
    // Se clicou em editar (mas ainda não salvou)
    elseif (isset($_POST['editar'])) {
        exibirFormularioEdicao($nome, $email, $mensagem);
    }
    // Primeira submissão
    else {
        exibirDados($nome, $email, $mensagem);
        exibirBotaoEditar($nome, $email, $mensagem);
    }
}
?>
</body>
</html>