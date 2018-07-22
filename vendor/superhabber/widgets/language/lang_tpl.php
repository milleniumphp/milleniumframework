<select class="form-control" name="lang" id="lang" style="margin-top: -6px;height: auto;">

    <option value="<?= $this->language['code']; ?>">
        <?= $this->language['title'] ?>
    </option>

    <?php foreach ($this->languages as $k => $v): ?>
        <?php if ($this->language['code'] != $k): ?>
            <option value="<?= $k; ?>">
                <?= $v['title'] ?>
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
