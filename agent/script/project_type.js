dashboardSoftlockTab = document.querySelector(".dashboard-softlock-tab");
dashboardConfirmTab = document.querySelector(".dashboard-confirm-tab");

dashboardSoftlockTab.addEventListener("click", () => {
  // console.log('softlock clicked');
  dashboardSoftlockFetch();

  dashboardSoftlockTab.classList.add("currently_set");
  dashboardConfirmTab.classList.remove("currently_set");
});

dashboardConfirmTab.addEventListener("click", () => {
  dashboardConfirmFetch();

  dashboardConfirmTab.classList.add("currently_set");
  dashboardSoftlockTab.classList.remove("currently_set");
});

function dashboardSoftlockFetch() {
  const AgentId = getcookie("AgentId");
  // const AgentId = 2;

  fetch("fetch/fetch_active_project.php", {
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
                
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          no records found
        </tbody>`;
        softlockDiv.innerHTML = tableHTML;
        // showNotification(" Softlocked Fetched");
      } else {
        const softlockDiv = document.getElementById(
          "dashboard-softlock-content"
        );

        let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>Project Id</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach((user) => {
          tableHTML += `
            <tr id='row${user.ProjectId}'>
                
                <td>${user.ProjectId}</td>
                <td>${user.ProjectName}</td>
                <td><button class='dashboard-open' data-project-id='${user.ProjectId}'>View</button>
                    
                </td>
            </tr>`;
        });

        tableHTML += `</tbody>
                </table>`;

        softlockDiv.innerHTML = tableHTML;
        // showNotification(" Softlocked Fetched");

        $("#myTable").DataTable();

        document.querySelectorAll(".dashboard-open").forEach((button) => {
          button.addEventListener("click", (event) => {
            // console.log(event.target.dataset.projectId);
            const ProjectId = event.target.dataset.projectId;
            openModal1(ProjectId);
          });
        });
      }
    });
}

function openModal1(ProjectId) {
  //Fetch  projectDetails from the server using ProjectId
  fetch(`fetch/getProjectDetails.php ?projectId=${ProjectId}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error("Error fetching project details: " + data.error);
        alert("No data found for closed project");
      } else {
        // console.log(data);
        document.getElementById("modal-content").innerHTML = "";
        const closeButton = document.createElement("span");
        closeButton.className = "close-btn";
        closeButton.innerHTML = "&times;";
        closeButton.onclick = function () {
          document.getElementById("user-modal").style.display = "none";
        };
        document.getElementById("modal-content").appendChild(closeButton);

        const projectNameElement = document.createElement("p");
        projectNameElement.textContent = `Project Name: ${data[0].ProjectName}`;
        projectNameElement.id = "modal-name";
        document.getElementById("modal-content").appendChild(projectNameElement);

        // Iterate over each project in the data array
        data.forEach((project) => {
          // Create new elements for each project
          outerDiv=document.createElement("div");
          outerDiv.className="outerDiv";

          const skillNameElement = document.createElement("p");
          // skillNameElement.id = "left";
          skillNameElement.innerHTML = `<strong>Skills: </strong>${project.SkillName}`;
          outerDiv.appendChild(skillNameElement);

          const usersElement = document.createElement("p");
          usersElement.innerHTML = `<strong>Users: </strong> ${project.Users}`;
          outerDiv.appendChild(usersElement);
          // Append the new elements to the modal content

          document.getElementById("modal-content").appendChild(outerDiv);
          // document.getElementById("modal-content").appendChild(usersElement);
        });

        //Show the modal
        const modal = document.getElementById("user-modal");
        modal.classList.remove("hide");
        modal.classList.add("show");
        modal.style.display = "block";
      }
    })
    .catch((error) => {
      console.error("Error fetching user data: " + error);
    });
}
function closeModal() {
  const modal = document.getElementById("user-modal");
  modal.classList.remove("show");
  modal.classList.add("hide");
  modal.addEventListener(
    "animationend",
    () => {
      modal.style.display = "none";
    },
    { once: true }
  );
}

document.querySelector(".close-btn").onclick = closeModal;

function dashboardConfirmFetch() {
  // console.log("dashboardConfirmFetch called");
  const AgentId = getcookie("AgentId");
  // const AgentId = 2;

  fetch("fetch/fetch_closed_project.php", {
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
                <th>Project Id</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach((user) => {
          tableHTML += `
            <tr id='row${user.ProjectId}'>
                <td>${user.ProjectId}</td>
                <td>${user.ProjectName}</td>
                <td><button class='dashboard-open-btn' data-project-id='${user.ProjectId}'>View</button>
                    
                </td>
            </tr>`;
        });

        tableHTML += `</tbody>
                </table>`;

        softlockDiv.innerHTML = tableHTML;
        // showNotification(" Confirm Fetched");
        $("#myTable").DataTable();

        document.querySelectorAll(".dashboard-open-btn").forEach((button) => {
          button.addEventListener("click", (event) => {
            console.log(event.target.dataset);
            openModal1(event.target.dataset.projectId);
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
          