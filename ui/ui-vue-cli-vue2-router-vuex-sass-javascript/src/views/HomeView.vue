<template>
  <div>
    <hello-world :msg="message" />
    <canvas-test />
  </div>
</template>

<script>
import HelloWorld from "@/components/HelloWorld";
import CanvasTest from "@/components/CanvasTest.vue";

export default {
  name: "HomeView",

  components: {
    HelloWorld,
    CanvasTest,
  },

  data() {
    return {
      message: "Hello from parent component!",
    };
  },
};
</script>
