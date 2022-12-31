<? // mui ?>

<form
  accept-charset="UTF-8"
>

<div class="form">

<div class="form-control">
  <p><?= $content['form-unaccepted-comment']['reason']?></p>
</div>


<div class="form-control">
  <div class="label"><label><?= _S ('ff--text-of-your-comment') ?></label></div>
  <textarea class="full-width" style="height: 16.7em; overflow-x: hidden; overflow-y: visible"
    readonly="true"
  ><?=$content['form-unaccepted-comment']['text']?></textarea>
</div>

</div>

</form>