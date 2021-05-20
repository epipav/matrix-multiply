<template>
  <div class="matrix-app-container">
    <h2>Please enter 2d matrices for multiplication.</h2>
    <h3>Columns separated with a comma, columns separated with newline character.</h3>
    <h4>
      Example input:
      <br />1,2,3
      <br />4,5,6
      <br />7,8,9
    </h4>
    <!--<b-button size="sm" @click="toggle">{{ show ? 'Hide' : 'Show' }} Alert</b-button>
    <b-alert v-model="show" class="mt-3" dismissible @dismissed="dismissed">Hello !</b-alert>-->
    <b-form-textarea
      class="matrix-area"
      id="textarea-1"
      v-model="matrix1"
      placeholder="Enter first matrix..."
      rows="3"
      max-rows="6"
    ></b-form-textarea>
    <div class="matrix-area mult-symbol"> X </div>
    <b-form-textarea
      class="matrix-area"
      id="textarea-2"
      v-model="matrix2"
      placeholder="Enter second matrix..."
      rows="3"
      max-rows="6"
    ></b-form-textarea>
    <div class="matrix-area mult-symbol"> = </div>
    <b-form-textarea
      readonly
      class="matrix-area"
      id="textarea-k2"
      v-model="result_matrix"
      placeholder=""
      rows="3"
      max-rows="6"
    ></b-form-textarea>
    <div class="error-msg" v-if="msg.matrix1">{{msg.matrix1}}</div>
    <div class="error-msg" v-if="msg.matrix2">{{msg.matrix2}}</div>
    <div class="error-msg" v-if="backend_error">{{backend_error}}</div>

    <b-button class="calculate-button" size="sm" @click="createArray">Calculate Matrix Mult</b-button>
  </div>
</template>
<script src="../welcome.js"></script>

