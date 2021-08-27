<template>
  <div>
    <to-do-list></to-do-list>
    
  </div>
</template>

<script>

/*import HelloWorld from './components/HelloWorld.vue'*/
import ToDoList from './components/ToDoList.vue'

export default {
  name: 'App',
  components: {
   /* HelloWorld,*/
    ToDoList,
  }
}
</script>

<style>

</style>
