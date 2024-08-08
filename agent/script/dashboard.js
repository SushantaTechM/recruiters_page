dashboardSoftlockTab = document.querySelector(".dashboard-softlock-tab");
dashboardConfirmTab = document.querySelector(".dashboard-confirm-tab");
dashboardAvailableTab = document.querySelector(".dashboard-available-tab");

dashboardSoftlockTab.addEventListener("click", () => {
  // console.log('softlock clicked');
  dashboardSoftlockFetch();
  dashboardAvailableTab.classList.remove("currently_set");
  dashboardSoftlockTab.classList.add("currently_set");
  dashboardConfirmTab.classList.remove("currently_set");
  
});

dashboardConfirmTab.addEventListener("click", () => {
  dashboardConfirmFetch();
  dashboardAvailableTab.classList.remove("currently_set");
  dashboardConfirmTab.classList.add("currently_set");
  dashboardSoftlockTab.classList.remove("currently_set");
  
});

dashboardAvailableTab.addEventListener("click", () => {
  dashboardAvailableFetch();
  console.log("fetch");
  dashboardAvailableTab.classList.add("currently_set");
  dashboardSoftlockTab.classList.remove("currently_set");
  dashboardConfirmTab.classList.remove("currently_set");
});

function dashboardSoftlockFetch() {
  
  const AgentId = getcookie("AgentId");
  // const AgentId = 2;

  fetch("fetch/fetch_get_softlock.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      AgentId: AgentId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "nodata") {
        
        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );
        softlockDiv.innerHTML = ``;

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          no records found
        </tbody>`;
        softlockDiv.innerHTML = tableHTML;
        showNotification(" Softlocked Fetched");
      } else {
        

        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach((user) => {
          tableHTML += `
            <tr id='row${user.UserId}'>
                <td>${user.FirstName}</td>
                <td>${user.LastName}</td>
                <td>${user.Email}</td>
                <td>${user.Phone}</td>
                <td>${user.ProjectName}</td>
                <td><button class='dashboard-open-btn' data-user-email='${user.UserId}'>View</button>
                    <button class='dashboard-confirm-btn' data-user-email='${user.UserId}'>Confirm</button>
                    <button class='dashboard-release-btn' data-user-email='${user.UserId}'>Release</button>
                </td>


            </tr>`;
        });

        tableHTML += `</tbody>
                </table>`;

        softlockDiv.innerHTML = tableHTML;
        showNotification(" Softlocked Fetched");

        $("#myTable").DataTable();

        document.querySelectorAll(".dashboard-open-btn").forEach((button) => {
          button.addEventListener("click", (event) => {
            // console.log(event.target.dataset.userEmail);
            openModal(event.target.dataset.userEmail);
          });
        });
        document.querySelectorAll(".dashboard-confirm-btn").forEach((button) => {
            button.addEventListener("click", (event) => {
              // console.log(event.target.dataset.userEmail);
              if (confirm("Are you really want to confirm the Employee")) {
                confirmDashboardUser(event.target.dataset.userEmail);
              }
            });
          });
          document.querySelectorAll(".dashboard-release-btn").forEach((button) => {
            button.addEventListener("click", (event) => {
              // console.log(event.target.dataset.userEmail);
              if (confirm("Are you really want to release the Employee")) {
                releaseConfirmUser(event.target.dataset.userEmail);
              }
            });
          });
      }
    });
}

function dashboardAvailableFetch() {
  // console.log("dashboardConfirmFetch called");
  const AgentId = getcookie("AgentId");
  // const AgentId = 2;

  fetch("fetch/fetch_get_available.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      AgentId: AgentId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "nodata") {
        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );
        softlockDiv.innerHTML = ``;

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr >
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          no records found
        </tbody>`;
        softlockDiv.innerHTML = tableHTML;
        showNotification(" Confirm Fetched");
      } else {
        // console.log(data);
        

        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );
        softlockDiv.innerHTML = ``;

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Primary Skill</th>
                <th>Secondary Skill</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach((user) => {
          tableHTML += `
            <tr id='row${user.UserId}'>
                <td>${user.FirstName}</td>
                <td>${user.LastName}</td>
                <td>${user.Email}</td>
                <td>${user.Phone}</td>
                <td>${user.PrimarySkill ? user.PrimarySkill : 'N/A'}</td>
                <td>${user.SecondarySkills ? user.SecondarySkills.split(',').join(', '):'N/A'}</td>
                <td><button class='dashboard-open-btn' data-user-email='${user.UserId}'>View</button>
                   
                </td>
            </tr>`;
        });

        tableHTML += `</tbody>
                </table>`;

        softlockDiv.innerHTML = tableHTML;
        showNotification(" Available Fetched");
        $("#myTable").DataTable();

        document.querySelectorAll(".dashboard-open-btn").forEach((button) => {
          button.addEventListener("click", (event) => {
            // console.log(event.target.dataset.userEmail);
            openModal(event.target.dataset.userEmail);
          });
        });
        // document.querySelectorAll(".available-btn").forEach((button)=>{
        //   button.addEventListener("click",(event)=>{
        //     showProjectCard(event.target.dataset.userId, event.target.dataset.action);
        //   });
        // });
      }
      
    //   function showProjectCard(userId,action){
    //     const cardDiv = document.createElement("div");
    //     cardDiv.classList.add("project-card");

    //     fetch("fetch/fetch_get_project.php")
    //     .then(response => response.json())
    //     .then(data=>{
    //       let dropdownHTML = '<select id="projectDropdown">';
    //       data.forEach(project => {
    //         dropdownHTML += `<option value="${project.ProjetId}">${project.ProjectName}</option>`;
    //       });
    //       dropdownHTML +='</select>';

    //       cardDiv.innerHTML = `<h3>${action === 'confirm'?'Confirm User': 'Softlock User'}</h3>
    //       ${dropdownHTML}
    //       <button id="confirmButton" data-user-id="${userId}" data-action="${action}">${action}</button>
    //       <button id="cancelButton">Cancel</button>
    //       `;

    //       document.body.appendChild(cardDiv);
    //       document.getElementById("confirmButton").addEventListener("click",(event)=>{
    //         confirmSoftlockUser(event.target.dataset.userId, event.target.dataset.action);
    //       });
    //       document.getElementById("cancelButton").addEventListener("click",()=>{
    //         cardDiv.remove();
    //       });
    //     })
    //     .catch(error =>{
    //       console.error("Error fetching projects:",error);
    //     });
    //   }
      
    });
}
function dashboardConfirmFetch() {
  // console.log("dashboardConfirmFetch called");
  const AgentId = getcookie("AgentId");
  // const AgentId = 2;

  fetch("fetch/fetch_get_confirm.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      AgentId: AgentId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "nodata") {
        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );
        softlockDiv.innerHTML = ``;

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr >
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          no records found
        </tbody>`;
        softlockDiv.innerHTML = tableHTML;
        showNotification(" Confirm Fetched");
      } else {
        // console.log(data);
        

        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );
        softlockDiv.innerHTML = ``;

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach((user) => {
          tableHTML += `
            <tr id='row${user.UserId}'>
                <td>${user.FirstName}</td>
                <td>${user.LastName}</td>
                <td>${user.Email}</td>
                <td>${user.Phone}</td>
                <td>${user.ProjectName}</td>
                <td><button class='dashboard-open-btn' data-user-email='${user.UserId}'>View</button>
                    <button class='dashboard-release-btn' data-user-email='${user.UserId}'>Release</button>
                </td>
            </tr>`;
        });

        tableHTML += `</tbody>
                </table>`;

        softlockDiv.innerHTML = tableHTML;
        showNotification(" Confirm Fetched");
        $("#myTable").DataTable();

        document.querySelectorAll(".dashboard-open-btn").forEach((button) => {
          button.addEventListener("click", (event) => {
            // console.log(event.target.dataset.userEmail);
            openModal(event.target.dataset.userEmail);
          });
        });
        document
          .querySelectorAll(".dashboard-release-btn")
          .forEach((button) => {
            button.addEventListener("click", (event) => {
              if (confirm("Are you really want to release the Employee")) {
                // console.log(event.target.dataset.userEmail);
                releaseConfirmUser(event.target.dataset.userEmail);
              }
            });
          });
      }
    });
}



function confirmDashboardUser(UserId) {
  // console.log("confirmDashboardUser called");
  if (UserId != null) {
    const AgentId=getcookie('AgentId');
    // const AgentId = 2;

    fetch("fetch/fetch_save_softlock_confirmation.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        UserId: UserId,
        AgentId: AgentId,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new error(response.statusText);
        }
        return response.json();
      })
      .then((data) => {
        if (data.status == "success") {
          showNotification("Employee Confirmed");

          const userElement = document.getElementById(`row${UserId}`);

          userElement.remove();
        } else {
          showNotification("Error: " + data.message, "error");
        }
      })
      .catch((error) => {
        showNotification("Error: " + error.message, "error");
      });
  }
}

function releaseConfirmUser(UserId) {
  const AgentId=getcookie('AgentId');
  // const AgentId = 2;
  fetch("fetch/release_confirm_user.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      UserId: UserId,
      AgentId:AgentId
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        showNotification("Employee Released");

        const userElement = document.getElementById(`row${UserId}`);

        userElement.remove();
      } else {
        showNotification("Error: " + data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Error: " + error.message, "error");
    });
}
