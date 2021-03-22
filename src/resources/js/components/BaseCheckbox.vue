<template>
  <div>
    <div>
      <input type="checkbox" v-model="checked" @click="checkedSendDB()" />
    </div>
  </div>
</template>

<script>
export default {
  props: ["orderId","userId","checkedGoods"],
  data() {
    return {
      checked: false,
      checkedSend:"0",
    };
  },
  watch:{
    checked:function(){
      if(this.checked == true){
        return this.checkedSend = "1";
      } else if (this.checked == false){
        return this.checkedSend = "0";
      }
    }
  },
  mounted() {
    if(this.checkedGoods == "1"){
      return this.checked = true;
    } else if(this.checkedGoods == "0"){
      return this.checked = false;
    }
  },
  methods: {
    checkedSendDB() {
            // タイマーで遅らせる理由
            // propsに弁1番が入っている時に弁2番を操作する→弁2番の操作が弁1番の方に反映されてしまう。
            setTimeout(
                () =>
                    // axiosでデータを送る(このコンポーネント=>app/Http/Request/StoreOption.php=>ValveController=>DB)
                    axios
                        .put("/api/order/" + this.orderId, {
                            user_id:this.userId,
                            checked_goods:this.checkedSend,
                        })
                        .then(response => {
                            console.log(response);
                        }),
                1000
            );
        },
  },
};
</script>

<style>
</style>