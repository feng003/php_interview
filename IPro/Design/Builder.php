<?php
/**
 * Bulider 创建者模式
 * 在建造者模式中有两个角色，一个是指挥者，一个是建造者。
 * 而下面这个购物车的例子中，选择商品的人，就是客户端用户就是指挥者。
 * Created by PhpStorm.
 * User: zhangb
 * Date: 2015/6/13
 * Time: 8:02
 */

class ShoppingCart
{
    private $_goods  = array();
    private $_tickets = array();

    /**
     * @param $goods
     */
    public function addGoods($goods)
    {
        $this->_goods[] = $goods;
    }

    public function addTicket($ticket)
    {
        $this->_tickets[] = $ticket;
    }

    public function printInfo()
    {
        printf("goods: %s , ticket:%s",implode(',',$this->_goods),implode(',',$this->_tickets));
    }
}

/**
 * 创建者类来封装购物车的数据组装
 * Class CardBuilder
 */
class CardBuilder
{
    private $_card;

    function __construct($card)
    {
        $this->_card = $card;
    }

    /**
     * 把购物车的 组装 封装到了CartBuilder的build方法
     * @param $data
     */
    function build($data)
    {
        foreach($data['goods'] as $goods)
        {
            $this->_card->addGoods($goods);
        }
        foreach($data['tickets'] as $ticket)
        {
            $this->_card->addTicket($ticket);
        }
    }

    function getCard()
    {
        return $this->_card;
    }
}
//用户勾选了这些商品和优惠政策
$data = array(
    'goods' => array('ipad air', '小米手机', '32G U盘'),
    'tickets' => array('减10元券', '包邮'),
);
$cart = new ShoppingCart();
$builder = new CardBuilder($cart);
$builder->build($data);
echo "after builder:";
$cart->printInfo();

