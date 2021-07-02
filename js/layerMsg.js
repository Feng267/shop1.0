function layerMsg(e){
    switch(e){
        case 1:
            layer.msg('加入购物车成功！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
            break;
        case 2:
            layer.msg('加入购物车失败！', { icon: 2, time: 1500, shade: [0.6, '#000', true] });
            break;
        case 3:
            layer.msg('请先登录！', { icon: 7, time: 1000, shade: [0.6, '#000', true] });
            break;
        case 4:
            layer.msg('确认收货成功！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
            break;
        case 5:
            layer.msg('确认收货失败！', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
            break;
        case 7:
            layer.msg('好的少侠，正在为您加紧发货呢！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
            break;
        default:
            layer.msg('该功能正在开发中，请稍后呢', { icon: 1, time: 1500, shade: [0.6, '#000', true] });
            break;
    }
}