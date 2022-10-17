<template>
  <router-view />
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.register input,
.login input,
.add input {
  width: 300px;
  height: 40px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 30px;
  border: 1px solid skyblue;
  padding-left: 20px;
}
.register button,
.login button,
.add button {
  width: 320px;
  height: 40px;
  border: 1px solid skyblue;
  background: skyblue;
  cursor: pointer;
  color: #fff;
}
</style>
