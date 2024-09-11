<script>
export default{
  data() {
    return{
      name: "Karnis",
      status: 'pending',
      tasks: ['Task1', 'Task2', 'Task3'],
      link: "https://google.com"

    };
  },
  methods: {
    toogleStatus()
    {
      if(this.status === 'active')
        this.status = 'pending';
      else if(this.status ===  'pending')
      this.status = 'inactive';
      else 
        this.status = 'active';
    }
  },
};
</script>

<template>
  <div>
  <h2>{{ name }} </h2>
  <br>
  <p v-if="status === 'active'">User is active</p>
  <p v-else-if="status === 'pending'">User is pending</p>
  <p v-else>User is inactive</p>
  <br>
  <h3>Tasks</h3>
  <ul>
    <li v-for="task in tasks" :key="task">{{ task }}</li>
  </ul>
  <br>
  <a :href="link">Click for Google</a>
  <br>
  <button @click = "toogleStatus">Change Status</button>
</div>
</template>