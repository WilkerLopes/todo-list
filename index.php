<?php
$titlePage = "To-do List";
include('components/Header.php')
?>

<div class="container">

  <div class="hero">
    <h1 class="title">Todo</h1>
    <p class="subtitle">Organize seu dia de forma eficiente com nosso app de tarefas. <br> Aumente sua produtividade agora!</p>
  </div>

  <form id="NewItem">
    <div class="line">
      <input require type="text" id="NewItemTitle" class="full" name="title" placeholder="Adicionar task">
      <button type="submit">Adicionar</button>
    </div>
  </form>

  <ul id="TodoItens" class="todo-list">
    <!-- Aqui serão adicionados os itens da lista de tarefas -->
  </ul>

  <div class="not-item" id="NoItem">
    <img src="https://api.iconify.design/solar:document-medicine-line-duotone.svg" alt="Not Itens">
    <h3 class="title">Você ainda não tem tarefas cadastradas </h3>
    <p class="subtitle"> Crie tarefas e organize seus itens a fazer </p>
  </div>

  <div class="modal">
    <div class="card">
      <div class="line">
        <h2 class="title">Editar</h2>
        <button class="icon" onclick="closeModal()">
          <img src="https://api.iconify.design/iconoir:cancel.svg" alt="close icon">
        </button>
      </div>
      <form id="EditItem">
        <input require type="text" id="EditItemTitle" name="title" placeholder="Editar task">
        <input require type="text" id="EditItemId" readonly name="title" class="hidden">
        <button type="submit">Editar</button>
      </form>
    </div>
  </div>
</div>


<?php include('components/Footer.php') ?>