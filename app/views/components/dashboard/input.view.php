<div class="control-group">
  <label class="control-label" for="<?= $name ?>"><?= $title ?></label>
  <div class="controls">
    <input type="<?= isset($type) ? $type : 'text'; ?>" id="<?= $name ?>" name="<?= $name ?>" <?= isset($required) ? ($required ? 'required' : '') : ''; ?> placeholder="<?= isset($placeholder) ? $placeholder : ''; ?>" class="form-control mr-sm-2" value="<?= isset($value) ? $value : ''; ?>" />
    <p class="help-block">
      <? isset($message)? $message : $title . "can contain any letters or numbers, without spaces"; ?>
    </p>
  </div>
</div>