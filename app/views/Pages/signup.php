<h2>Sign Up</h2>

<?php if(isset($session->data['error'])):?>
    <div class="alert alert-danger">
        <?php echo $session->data('error') ?>
    </div>
<?php endif;?>
    
<div class="row">
    <div class="col-md-6">

        <?php $form = mill\html\Form::create(['method'=>'post', 'action'=>'real'])?>
            <div class="form-group">
                <?=$form->field($model, 'login', [
                    'label'=>'Please enter login',
                ])?>
            </div>
            <div class="form-group">
                <?=$form->field($model, 'password', [
                    'label'=>'Please enter Password',
                    'type'=>'password'
                ])?>
                
            </div>
            <div class="form-group">
                <?=$form->field($model, 'name', [
                    'label'=>'Please enter Name',
                ])?>
            </div>
            <div class="form-group">
                <?=$form->field($model, 'email', [
                    'label'=>'Please enter Email',
                ])?>
            </div>
            <div class="form-group">
                <?=$form->submit([
                    'class'=>'btn btn-success',
                    'id' => 'submit'
                ])?>
            </div>
        <?php $form->end()?>

    </div>
</div>
