define(
  [
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
  ],
  function (Component,
            rendererList) {
    'use strict';
    rendererList.push(
      {
        type: 'custom_payment',
        component: 'Vendic_OfflinePayments/js/view/payment/method-renderer/generic-method'
      }
    );
    return Component.extend({});
  }
);