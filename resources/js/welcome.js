import Axios from "axios";

export default {
  data() {
    return {
      show: true,
      matrix1: '',
      matrix2: '',
      msg: [],
      matrices: [],
      result_matrix: '',
      backend_error: ''
    };
  },
  watch: {
    deep: true,
    matrix1(newValue) {
      this.matrix1 = newValue;
      if (this.validateMatrix(newValue, "First matrix", "matrix1")) {
        this.generateArray(this.matrix1, 0);
      }
      this.backend_error = '';
    },
    matrix2(newValue) {
      this.matrix2 = newValue;
      if (this.validateMatrix(newValue, "Second matrix", "matrix2")) {
        this.generateArray(this.matrix2, 1)
      }
      console.log("new val m1: " + newValue);
      console.log("logging matrices: ");
      console.log(this.matrices);
      this.backend_error = '';

    },
    result_matrix(newValue) {
      this.result_matrix = newValue;
    },
    msg(newValue) {
      this.msg = newValue;
    }
  },
  methods: {
    createArray() {
      const payload = this.matrices;
      this.backend_error = "";
      Axios.post('/api/matrix_multiply', payload)
        .then(response => {
          if (response.data["success"]) {
            this.result_matrix = this.generateString(response.data["result_stringified"]);
          }
          else {
            this.backend_error = response.data["error"];
          }
        });
    },
    validateMatrix(value, name, messageIndex) {
      const rows = value.split("\n");

      const colCount = rows[0].split(",").length;
      this.msg[messageIndex] = "";
      var isValid = true;


      for (const row of rows) {
        const cols = row.split(",");
        if (colCount !== cols.length) {
          this.msg[messageIndex] = name + " is invalid. (Different column count per row.)";
          return !isValid;
        }

        for (const el of cols) {
          console.log("current el: " + el);
          if (isNaN(el) || el === "") {
            this.msg[messageIndex] = name + " is invalid. (Non integer value: " + el + ")";
            return !isValid;
          }
        }

      }
      return isValid;
    },
    generateString(matrix) {
      var string = "";
      for (var a = 0; a < matrix.length; a++) {
        for (var b = 0; b < matrix[0].length; b++) {
          string = string + matrix[a][b] + ",";
        }
        //change last unnecessary comma to newline
        string = string.replace(/,\s*$/, "\n");
      }
      return string;
    },
    generateArray(matrix, index) {
      var array = [];
      const rows = matrix.split("\n");

      var rowNumber = 0;
      for (const row of rows) {
        const cols = row.split(",");

        array[rowNumber] = [];
        var colNumber = 0;
        for (const el of cols) {

          array[rowNumber][colNumber] = el;
          colNumber++;
        }
        rowNumber++;
      }
      this.matrices[index] = array;
    }
  }
};