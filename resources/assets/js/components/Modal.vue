<template>
  <!-- START MODAL -->
  <div class="modal" :class="[{'d-block' : showModal}]">
    <div class="modal-content">
      <div class="modal-header text-blue">
        <span class="close" @click="showModal = false">&times;</span>
        <h4 >{{ title }}</h4>
      </div>
        <div class="modal-body">
          <h4>{{ content }}</h4>
        </div>
        <div class="modal-footer mb-0">

          <div class="float-right" v-if="buttonType === 'okCancel'">
              <button class="btn btn-blue close" @click="submitForm">Ok</button>
              <button class="btn btn-grey close" @click="showModal = false">Cancel</button>
          </div>

          <div class="float-right" v-else-if="buttonType === 'yesNo'">
              <button class="btn btn-blue" @click="submitForm">Yes</button>
              <button class="btn btn-grey close" @click="showModal = false">No</button>
          </div>

        </div>
    </div>
  </div>
  <!-- END MODAL -->
</template>

<script>
  export default {
    data() {
      return {
        id: '',
        url: '',
        type: '',
        title: '',
        content: '',
        buttonType: '', //okCancel, yesNo,
        showModal : '',

      }
    },

    mounted() {
      this.$el.addEventListener('click', this.onClose);
    },

    methods: {
      init(id = '', url = '', type, title, content, buttonType) {
        let self = this;
        self.id = id;
        self.url = url;
        self.type = type;
        self.title = title;
        self.content = content;
        self.buttonType = buttonType;
        self.showModal = true;
      },

      onClose(e) {
        if (e.target == this.$el)
          this.showModal = false;
      },

      submitForm() {
        let self = this;
        if(self.type == 'delete')
        {
          self.delete();
        }
      },

      delete() {
        let self = this;
        self.showModal = false;
        axios.delete(self.urrl)
        .then(data => {
          self.$parent.makeAlert('success', '', data.data);
          self.$parent.fetchData();
        })
        .catch(err => console.log(err) );
      },
    },
  }
</script>