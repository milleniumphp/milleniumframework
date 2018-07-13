<h2>Login</h2>
<?php if(isset($session->data['error'])):?>
<div class="alert alert-danger">
    <?php echo $session->data('error') ?>
</div>
<?php endif;?>
<div class="row">
    <div class="col-md-6">
        <!--Create new form-->
        <?php $form = mill\html\Form::create(['method' => 'post', 'action' => 'real', 'id'=>'login-form']) ?>
        <!--First form field with options-->
            <div class="form-group">
                <?=$form->field($user, 'login', [
                    'label' => 'User Login',
                    'class' => 'form-control user',
                    'name' => 'login'
                ])?>
            </div>
        <!--second form field-->
            <div class="form-group">
                <?=$form->field($user, 'password',[
                    'type' => 'password',
                    'name' => 'password'
                ])?>
            </div>
        <!--success button almost with params-->
            <div class="form-group">
                <?= $form->submit(
                    ['class' => 'btn btn-success'
                ]) ?>
            </div>
        <!--End Form tag-->
        <?php $form->end() ?>    
        
    </div>
</div>
