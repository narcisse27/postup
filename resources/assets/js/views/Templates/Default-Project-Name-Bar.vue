<template lang="html">
  <div class="col-lg-12">
    <div class="col-lg-11">
      <div class="col-lg-1">
        <h4><span class="ion-ios-folder-outline"></span></h4>
      </div>
      <div class="form-group">
        <div class="col-lg-11">
          <input type="text" class="form-control"   placeholder="nomdutemplate">
        </div>
      </div>
    </div>
    <div class="col-lg-1">
      <div v-if="factoryTemplate"  class="ion-btn"  >
        <span class="ion-checkmark-round" title="enrengistrer ce template"></span>
      </div>
      <div v-else class="ion-btn" >
        <span class="ion-edit" title="mettre à jour les modifications"></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="css">
</style>
