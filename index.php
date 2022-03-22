<?php
    require_once 'class/Message.php';
    require_once 'class/GuestBook.php';

    $title = "Livre d'or";

    $errors = null;
    $success = false;
    $guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');

    if (isset($_POST['username'], $_POST['message'])) {
        $message = new Message($_POST['username'], $_POST['message']);
        if ($message->isValid()) {
            $guestbook->getMessage($message);
            $success = true;
            $_POST = [];
        } else {
            $errors = $message->getErrors();
        }
    }

    $messages = $guestbook->getMessages();

    require "elements/header.php";
?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            Merci pour votre message
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

    <?php if (!empty($messages)): ?>
        <h2 class="mt-4">Vos messages</h2>

        <?php foreach ($messages as $message): ?>
            <?= $message->toHTML() ?>
        <?php endforeach ?>
    <?php endif ?>
</div>

<?php
    require "elements/footer.php";
?>