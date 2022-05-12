<template>
  <div class="m-5 py-5">
    <div v-if="$attrs.flash.message">
      <p class="text-success">{{ $attrs.flash.message }}</p>
    </div>
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#exampleModal"
      @click="create()"
    >
      Create New Post
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Title</th>
          <th scope="col">Body</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in data.data">
          <td>{{ row.id }}</td>
          <td>{{ row.title }}</td>
          <td>{{ row.body }}</td>
          <td>
            <button
              @click="edit(row)"
              class="btn btn-primary me-3"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              Edit
            </button>
            <button @click="deleteRow(row)" class="btn btn-danger">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    
  <ul class="pagination">
    <li class="page-item"><Link  class="page-link" :href="data.prev_page_url">Previous</Link></li>
    <li v-for="page,i in data.last_page" :key="i" class="page-item"><Link  class="page-link" :href="'/posts?page='+page">{{page}}</Link></li>
    <li class="page-item"><Link class="page-link" :href="data.next_page_url">Next</Link></li>
  </ul>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>New Post</b></h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div>
                <div>
                  <div>
                    <label for="exampleFormControlInput1"><b>Title: </b></label>
                    <input
                      type="text"
                      id="exampleFormControlInput1"
                      placeholder="Enter Post Title.."
                      v-model="form.title"
                    />
                    <div v-if="errors.title" class="text-danger">
                      {{ errors.title }}
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="exampleFormControlInput2"><b>Body: </b></label>
                    <textarea
                      id="exampleFormControlInput2"
                      placeholder="Enter Post Body.."
                      v-model="form.body"
                    ></textarea>
                    <div v-if="errors.title" class="text-danger">
                      {{ errors.body }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <button
                  wire:click.prevent="store()"
                  type="button"
                  class="btn btn-success"
                  v-show="!editMode"
                  @click="save(form)"
                >
                  Save
                </button>
                <button
                  wire:click.prevent="update()"
                  type="button"
                  class="btn btn-success"
                  v-show="editMode"
                  @click="update(form)"
                >
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {Link } from '@inertiajs/inertia-vue3';
export default {
  components: {
    Link,
  },
  props: ["data", "errors"],
  data() {
    return {
      form: {
        title: null,
        body: null,
      },
    };
  },
  methods: {
    reset: function () {
      this.form = {
        title: null,
        body: null,
      };
    },
    save: function (data) {
      this.$inertia.post("/posts", data);
      this.reset();
      this.$router.push("/home");
    },
    edit: function (data) {
      this.form = Object.assign({}, data);
      this.editMode = true;
    },
    create: function () {
      this.reset();
      this.editMode = false;
    },
    update: function (data) {
      data._method = "PUT";
      this.$inertia.post("/posts/" + data.id, data);
      this.reset();
    },
    deleteRow: function (data) {
      if (!confirm("Are you sure want to remove?")) return;
      data._method = "DELETE";
      this.$inertia.post("/posts/" + data.id, data);
      this.reset();
    },
  },
};
</script>

<style scoped>
input[type="text"],
select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

#exampleFormControlInput2 {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
div {
  border-radius: 5px;
  background-color: #ffff;
  padding: 10px;
}
</style>