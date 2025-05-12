<?php
function renderInput($type, $name, $label, $value = '', $required = false, $placeholder = '')
{
    ob_start();
    ?>
    <div class="form-group">
        <label for="<?= $name ?>" class="form-label"><?= htmlspecialchars($label) ?><?= $required ? ' <span class="required">*</span>' : '' ?></label>
        <input 
            type="<?= $type ?>" 
            id="<?= $name ?>" 
            name="<?= $name ?>" 
            class="form-control" 
            value="<?= htmlspecialchars($value) ?>" 
            placeholder="<?= htmlspecialchars($placeholder) ?>"
            <?= $required ? 'required' : '' ?>
        >
    </div>
    <?php
    return ob_get_clean();
}

function renderButton($text, $type = 'submit', $class = 'btn-primary')
{
    ob_start();
    ?>
    <button type="<?= $type ?>" class="btn <?= $class ?>"><?= htmlspecialchars($text) ?></button>
    <?php
    return ob_get_clean();
}

function renderForm($action, $method, $content, $enctype = '')
{
    ob_start();
    ?>
    <form action="<?= $action ?>" method="<?= $method ?>" class="form" <?= $enctype ? "enctype=\"$enctype\"" : '' ?>>
        <?= $content ?>
    </form>
    <?php
    return ob_get_clean();
}
?> 