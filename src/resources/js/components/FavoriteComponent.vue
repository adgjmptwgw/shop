<template>
  <div>
    <input
      type="submit"
      :value="favorite"
      class="btn btn-primary"
      @click="is_favorite(),is_favorite_axios()"
    />
  <!-- {{orderId[0]}} -->
  </div>
</template>

<script>
export default {
  props: ["orderId", "favoriteId", "favoriteUser"],
  data() {
    return {
      orders_id: "",
      favorite: "お気に入り登録",
    };
  },
  methods: {
    is_favorite: function () {
      if (this.favorite == "お気に入り登録") {
        return (this.favorite = "お気に入り解除");
      } else if (this.favorite == "お気に入り解除") {
        return (this.favorite = "お気に入り登録");
      }
    },
    is_favorite_axios() {
      if (this.favorite == "お気に入り解除") {
        // console.log(this.orderId[0].id);
        setTimeout(
          () =>
            axios
              .post("/api/favorite", {
                user_id: this.favoriteUser,
                goods_id: this.favoriteId,
                favorite_switch: 1,
              })
              .then((response) => {
                console.log(response);
              }),
          200
        );
      } else if (this.favorite == "お気に入り登録") {
        for (let i = 0; i <= this.orderId.length; i++) {
          console.log("test");
          if(this.orderId[i].favorite_switch == 1){
            // return this.orders_id = this.orderId[i].id;
            console.log("test2");
          }
          }
        }
        setTimeout(
          () =>
            axios.delete("/api/favorite/" + this.orders_id).then((response) => {
              console.log(response);
            }),
          200
        );
      }
    },
};
</script>
