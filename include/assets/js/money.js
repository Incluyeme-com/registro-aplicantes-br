  import { money } from "v-money";
  export default {
    directives: { money }, 
    data() {
      return {
        price: 123.45,
        rawPrice: null,
        money: {
          decimal: ",",
          thousands: ".",
          prefix: "R$ ",
          suffix: " #",
          precision: 2,
          unmaskedVar: "rawPrice" 
        }
      };
    }
  };