const baseURl = "http://localhost/todo-list/api/";

$(document).ready(function () {
  loadTodo();

  $("#NewItem").on("submit", (event) => {
    event.preventDefault();
    var data = {
      title: $("#NewItemTitle").val(),
    };

    request("todo", "POST", data)
      .then((res) => {
        loadTodo();
        $("#NewItemTitle").val("");
      })
      .catch((err) => {
        console.log(err);
      });
  });

  $("#EditItem").on("submit", (event) => {
    event.preventDefault();
    var data = {
      title: $("#EditItemTitle").val(),
    };
    console.log();

    request(`todo/${$("#EditItemId").val()}`, "PATCH", data)
      .then((res) => {
        loadTodo();
        closeModal();
      })
      .catch((err) => {
        console.log(err);
      });
  });
});

function loadTodo() {
  request("todo")
    .then((res) => {
      var todoList = $("#TodoItens");
      todoList.empty();

      if (res.length <= 0) {
        $("#NoItem").show();
      } else {
        $("#NoItem").hide();
      }

      res.forEach((element) => {
        let status = element.completed ? "completed" : "";
        let checked = element.completed ? "checked" : "";
        let item = `
        <li data-id="${element.id}" class="todo-item ${status}">
          <label>
            <input type="checkbox" ${checked} onchange="checkItem(${element.id}, ${element.completed})" />
            <p>${element.title}</p>
            <div class="space"></div>
            <button class="icon" onclick="editItem('${element.id}', '${element.title}')">
              <img src="https://api.iconify.design/solar:pen-new-square-line-duotone.svg" alt="edit icon" />
            </button>
            <button class="icon" onclick="deleteItem(${element.id})">
              <img src="https://api.iconify.design/solar:trash-bin-trash-line-duotone.svg" alt="delete icon" />
            </button>
          </label>
        </li>`;

        todoList.append(item);
      });
    })
    .catch((err) => {
      console.log(err);
    });
}

function checkItem(id, status) {
  request(`todo/${id}`, "PATCH", { completed: status == 1 ? false : true })
    .then((res) => {
      loadTodo();
    })
    .catch((err) => {
      console.log(err);
    });
}

function editItem(id, title) {
  $(".modal").addClass("open");
  $("#EditItemId").val(id);
  $("#EditItemTitle").val(title);
}

function deleteItem(id) {
  request(`todo/${id}`, "DELETE")
    .then((res) => {
      loadTodo();
    })
    .catch((err) => {
      console.log(err);
    });
}

async function request(url, method = "GET", data = null) {
  let config = {
    url: baseURl + url,
    type: method,
    contentType: "application/json",
    success: function (response) {
      return new Promise((resolve, reject) => {
        resolve(response);
      });
    },
    error: function (xhr, status, error) {
      return new Promise((resolve, reject) => {
        reject(error);
      });
    },
  };

  if (data) config.data = JSON.stringify(data);

  return $.ajax(config);
}

function openModal() {
  $(".modal").addClass("open");
}
function closeModal() {
  $(".modal").removeClass("open");
}
