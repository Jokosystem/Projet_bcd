<?php
require_once "./includes/header.php";
require_once "./src/UserModel.php";
isLogged();
$userModel = new UserModel();
$userModel->modifyPassword();
?>

<form method="post" class="w-1/2 mx-auto bg-white border rounded p-4 shadow-md">
  <h1 class="text-4xl font-light text-center mb-10 uppercase">Modifier mon mot de passe</h1>

  <div class="mb-4">
    <label class="block mb-2" for="current">Mot de passe actuel:</label>
    <input class="border rounded border-gray-100 py-2 px-4 w-full outline-none shadow-sm" type="password" name="current" id="current">
  </div>

  <div class="mb-4">
    <label class="block mb-2" for="newPassword">Nouveau mot de passe:</label>
    <input class="border rounded border-gray-100 py-2 px-4 w-full outline-none shadow-sm" type="password" name="newPassword" id="newPassword">
  </div>

  <div class="mb-4">
    <label class="block mb-2" for="confirm">Confirmer le mot de passe:</label>
    <input class="border rounded border-gray-100 py-2 px-4 w-full outline-none shadow-sm" type="password" name="confirm" id="confirm">
  </div>

  <button class="w-full rounded p-4 bg-green-500 hover:bg-green-700 text-white font-semibold">
  <i class="fa-solid fa-paper-plane mr-2"></i>Envoyer
  </button>
</form>

<?php require_once "./includes/footer.php" ?>