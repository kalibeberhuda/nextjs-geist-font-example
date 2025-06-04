<div class="language-switcher">
    <form method="post" action="/language/change" class="d-inline">
        <?= csrf_field() ?>
        <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm" style="width: auto; display: inline-block;">
            <option value="en" <?= service('request')->getLocale() === 'en' ? 'selected' : '' ?>>English</option>
            <option value="id" <?= service('request')->getLocale() === 'id' ? 'selected' : '' ?>>Bahasa Indonesia</option>
        </select>
    </form>
</div>
