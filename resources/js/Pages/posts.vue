<template>
  <div class="m-5 py-5">
        <!-- <div v-if="$page.flash.message" >
          <p>{{ $page.flash.message }}</p>
        </div> -->
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
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
        <tr v-for="row in data">
          <td>{{ row.id }}</td>
          <td>{{ row.title }}</td>
          <td>{{ row.body }}</td>
          <td>
            <button @click="edit(row)" class="btn btn-primary me-3" data-bs-toggle="modal"
        data-bs-target="#exampleModal">Edit</button>
            <button @click="deleteRow(row)" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

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
            <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
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
                    <label for="exampleFormControlInput1">Title:</label>
                    <input type="text" placeholder="Enter Title" v-model="form.title" />
                  </div>
                  <div class="mb-4">
                    <label for="exampleFormControlInput2">Body:</label>
                    <textarea v-model="form.body"></textarea>
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
                <button wire:click.prevent="store()" type="button" class="btn btn-success" v-show="!editMode" @click="save(form)">Save</button>
                <button wire:click.prevent="update()" type="button" class="btn btn-success" v-show="editMode" @click="update(form)">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
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
    } ,
            edit: function (data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
               
            },
            update: function (data) {
                data._method = 'PUT';
                this.$inertia.post('/posts/' + data.id, data)
                this.reset();
            },
            deleteRow: function (data) {
                if (!confirm('Are you sure want to remove?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/posts/' + data.id, data)
                this.reset();
            },
  },
};
</script>