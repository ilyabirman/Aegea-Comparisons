<? // mui ?>

<form
  action="<?= @$content['form-database']['form-action'] ?>"
  method="post"
>

<div class="form">

<div class="form-control">
  <div class="label">
    <label><?= _S ('ff--db-host') ?></label>
  </div>
  <input type="text"
    name="db-server"
    id="db-server"
    class="text input-editable width-2"
    value="<?= @$content['form-database']['db-server'] ?>"
  />
</div>

<div class="form-control">
  <div class="form-subcontrol">
    <div class="label">
      <label><?= _S ('ff--db-username-and-password') ?></label>
    </div>
    <input type="text"
      name="db-user"
      id="db-user"
    class="text input-editable width-2"
      value="<?= @$content['form-database']['db-user'] ?>"
    />
  </div>
  <div class="form-subcontrol">
    <input type="text"
      name="db-password"
      id="db-password"
    class="text input-editable width-2"
      value="<?= @$content['form-database']['db-password'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="label">
    <label><?= _S ('ff--db-name') ?></label>
  </div>
    <input type="text"
    name="db-database"
    id="db-database"
    class="text input-editable width-2"
    value="<?= @$content['form-database']['db-database'] ?>"
  />
</div>

<div class="form-control">
  <div class="label">
    <label><?= _S ('ff--db-prefix') ?></label>
  </div>
    <input type="text"
    name="db-prefix"
    id="db-prefix"
    class="text input-editable width-1"
    value="<?= @$content['form-database']['db-prefix'] ?>"
  />
</div>

<div>
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-database']['submit-text'] ?>
  </button>
</div>

</div>


</form>