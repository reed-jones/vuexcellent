# Introduction

A Vuex preloader for Laravel.

![Excellent](./excellent.gif)

Vuexcellent is a set of libraries originally designed to help load data from your laravel backend to your Vue app during the initial page load. The general idea is to set your desired vuex state from within Controllers or Models, and have it instantly available without needing to juggle passing the data in through props, or make extra api calls to load the initial data. Once installed, usage is designed to be quite straight forward. As of version `v1.2.0`, Vuexcellent has the capability to intercept axios api calls and commit the updated values to the store automatically.

```php
// PostController.php

public function index() {
    // Set the initial vue state
    Vuex::state([
        'posts' => Posts::paginate(15)
    ]);

    // Navigate to the view as
    // you normally would
    return view('blogPosts');
}
```

```vue
<template>
    <div v-for="post in $store.state.posts" :key="post.id">
        <a :href="`/posts/${post.slug}`">{{ post.title }}</a>
    </div>
</template>
```

And thats it for the page load. To get the next page of blog posts, one could send an axios request to the backend for page 2 and it would automatically be reflected on screen.
```vue
<template>
<button @click="nextPage">Next</button>
</template>

<script>
export default {
  data: _ => ({
      page: 1
  }),
  methods: {
      nextPage() {
          axios.get(`/api/posts?page=${++page}`)
      }
  }
}
</script>
```
```php
// PostController.php
public function search() {
    // Set the initial vue state
    Vuex::state([
        'posts' => Posts::paginate(15)
    ]);

    // the updated posts from page 2 will be automatically committed
    // and available
    return response()->vuex();
```


```vue
<template>
    <!-- These are now page 2 posts -->
    <div v-for="post in $store.state.posts" :key="post.id">
        <a :href="`/posts/${post.slug}`">{{ post.title }}</a>
    </div>
</template>
```
