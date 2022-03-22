<?php
    require_once 'class/Message.php';

    $title = "Livre d'or";

    $errors = null;

    if (isset($_POST['username'], $_POST['message'])) {
        $message = new Message($_POST['username'], $_POST['message']);
        if ($message->isValid()) {

        } else {
            $errors = $message->getErrors();
        }
    }

    require "elements/header.php";
?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif ?>

    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="username" value="<?= htmlentities($_POST['username'] ?? '') ?>" placeholder="Votre pseudo" class="form-control <?= $errors['username'] ? 'is-invalid' : '' ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['username'] ?>
                </div>
            <?php endif ?>
        </div>
        <div class="form-group">
            <textarea name="message" id="" placeholder="Votre message" class="form-control <?= $errors['message'] ? 'is-invalid' : '' ?>"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
            <?php if (isset($errors['message'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['message'] ?>
                </div>
            <?php endif ?>
        </div>
        <button class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php
    require "elements/footer.php";
?>