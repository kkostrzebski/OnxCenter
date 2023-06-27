<template>
  <div>
    <h1>Vue</h1>
    <router-view></router-view>

    <router-link to="/customers/1">Szczegóły klienta</router-link>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>

div {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}


h1 {
  font-size: 24px;
  text-align: center;
  margin-bottom: 20px;
}


router-view {
  margin-top: 20px;
}


</style>