<div id="CartModalWindow" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your cart</h4>
            </div>
            <div class="modal-body">
                <? if (is_array($c)): ?>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Name</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td class="total">Total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($c as $product): ?>
                                    <tr>
                                        <td class="cart_product ">
                                            <div class="text-left row">
                                                <img class="img-responsive" style="max-height:50px" src="<?=$product[2]['image']?>" alt="">
                                            </div>     
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""><?=$product[1]['title']?></a></h4>
                                            <p>Web ID: <?=$product[0]['id']?></p>
                                        </td>
                                        <td class="cart_price" id="<?=$product[0]['id'].'_price'?>">
                                            <p>$<?=$product[4]['price']?></p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <a href="" class="cart_quantity_up" onclick="
                                                    $('#<?=$product[0]['id'].'_count'?>').val(parseInt($('#<?=$product[0]['id'].'_count'?>').val())+1);
                                                    $('#<?=$product[0]['id'].'_total'?> .cart_total_price').text(parseInt($('#<?=$product[0]['id'].'_total'?> .cart_total_price').text()) +  <?=$product[4]['price']?> );
                                                    return false"> + </a>
                                                <input class="cart_quantity_input" id="<?=$product[0]['id'].'_count'?>" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                                <a class="cart_quantity_down" href="" onclick="
                                                    $('#<?=$product[0]['id'].'_count'?>').val(parseInt($('#<?=$product[0]['id'].'_count'?>').val())-1);
                                                    $('#<?=$product[0]['id'].'_total'?> .cart_total_price').text(parseInt($('#<?=$product[0]['id'].'_total'?> .cart_total_price').text()) -  <?=$product[4]['price']?> );
                                                    return false"> - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total" id="<?=$product[0]['id'].'_total'?>">
                                            $<p class="cart_total_price"><?=$product[4]['price']?></p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            <? endforeach; ?>
                        </table>
                    </div>
                <? else: ?>        
                    <p><?= $c ?></p>
                <? endif; ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closecart('CartModalWindow')">Close</button>
            </div>
        </div>

    </div>
</div>