$(function () {
  const $cartQuantity = $("#cart-quantity");
  const $addToCart = $(".btn-add-to-cart");
  const $itemQuantities = $(".item-quantity");
  $addToCart.click((e) => {
    e.preventDefault();
    const $this = $(e.target);
    const id = $this.closest(".product-item").data("key");
    console.log(id);
    $.ajax({
      method: "POST",
      url: $this.attr("href"),
      data: { id },
      success: function () {
        console.log("success");
        $cartQuantity.text(parseInt($cartQuantity.text() || 0) + 1);
      },
    });
  });

  $itemQuantities.change((e) => {
    e.preventDefault();
    const $this = $(e.target);
    const $tr = $this.closest("tr");
    const id = $tr.data("id");
    $.ajax({
      method: "POST",
      url: $tr.data("url"),
      data: { id, quantity: $this.val()},
      success: function (totalQuantity) {
        console.log(arguments);
        $cartQuantity.text(totalQuantity)
      },
    });
  });
});
