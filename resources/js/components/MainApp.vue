<template>
  <div>
    <p>{{ message }}</p>
  </div>
</template>

<script>
// import Pusher from "pusher-js";
const app_key = process.env.MIX_PUSHER_APP_KEY;
const app_cluster = process.env.MIX_PUSHER_APP_CLUSTER;
const pusher = new Pusher(app_key, {
  cluster: app_cluster
});

const channel = pusher.subscribe("test-pusher");

export default {
  name: "MainApp",
  data() {
    return {
      message: "tests"
    };
  },
  methods: {
      setState(data) {
          this.message = data.message;
      }
  },
  mounted() {
      channel.bind("my-event", (data) => {
        this.setState(data)
      });
  }
};
</script>
