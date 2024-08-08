document.addEventListener("DOMContentLoaded", (event) => {
  populateFilters();
  filterResults();
});

function populateFilters() {
  fetch("fetch/fetch_filters.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok " + response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      const locationFilter = document.getElementById("location-filter");
      const skillFilter = document.getElementById("skill-filter");
      // const experienceFilter = document.getElementById("experience-filter");

      data.locations.forEach((location) => {
        const option = document.createElement("option");
        option.value = location;
        option.textContent = location;
        locationFilter.appendChild(option);
      });

      data.skills.forEach((skill) => {
        const option = document.createElement("option");
        option.value = skill;
        option.textContent = skill;
        skillFilter.appendChild(option);
      });

      // data.experiences.forEach((experience) => {
      //   const option = document.createElement("option");
      //   option.value = experience;
      //   option.textContent = experience;
      //   experienceFilter.appendChild(option);
      // });
    })
    .catch((error) => {
      console.error(
        "There has been a problem with your fetch operation:",
        error
      );
    });
}

function filterResults() {
  const searchTerm = document.getElementById("search-bar").value;
  const location = document.getElementById("location-filter").value;
  const skill = document.getElementById("skill-filter").value;
  const experience = document.getElementById("experience-filter").value;

  fetch("fetch/fetch_results.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      searchTerm,
      location,
      skill,
      experience,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      // console.log(data)
      const resultsContainer = document.getElementById("results");

      resultsContainer.innerHTML = "";

      let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>Name</th>
                <th>Exp</th>
                <th>Loc</th>
                <th>Primary Skill</th>
                <th>Recruiter</th>
                <th>Project</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>`;
      data.forEach((user) => {
        tableHTML += `
            <tr id='row${user.UserId}'>
                <td>${user.FirstName} ${user.LastName}</td>
                
                <td>${user.Experience} </td>
                <td>${user.LocationName}</td>
                <input type="hidden" id="skillName" value="${user.SkillId}">
                <input type="hidden" id="projectskill" value="">
                <td >${user.SkillName}</td>
                

                <td id="agentName">${
                  user.UserName == null ? "-------" : user.UserName
                }</td>
                <td id="projectName">${
                  user.ProjectName == null ? "-------" : user.ProjectName
                }</td>

                <td>
                    ${
                      user.Status == "confirm"
                        ? '<img class="search_user_status confirm" src="../images/confirm.svg" />'
                        : user.Status == "softlock"
                        ? '<img class="search_user_status lock" src="../images/softlock.svg" />'
                        : '<img class="search_user_status unlock" src="../images/unlock.svg" />'
                    }
                </td>
                <td>
                    <button id='search-softlock-btn' class='search-softlock-btn' ${
                      user.Status == "confirm"
                        ? "Disabled"
                        : user.Status == "softlock"
                        ? "Disabled"
                        : ""
                    }  data-user-email='${user.UserId}'>Softlock</button>
                    <button class='search-confirm-btn'  ${
                      user.Status == "confirm"
                        ? "Disabled"
                        : getcookie("AgentId") != user.AgentId &&
                          user.AgentId != null
                        ? "Disabled"
                        : ""
                    } data-user-email='${user.UserId}'>Confirm</button>
                </td>
                
            </tr>`;
      });
      tableHTML += `</tbody>
                </table>`;

      resultsContainer.innerHTML = tableHTML;

      $("#myTable").DataTable();
      document.querySelectorAll(".search-softlock-btn").forEach((button) => {
        button.addEventListener("click", (event) => {
          //   if (confirm("Are you really want to soft lock the Employee")) {
          parentRow = event.target.closest("tr");
          skillname = parentRow.querySelector("#skillName").value;
          // console.log(skillname);
          showSoftlockModal(event.target.dataset.userEmail, skillname);
          //   }
          //   console.log(event.target.dataset.userEmail);
        });
      });

      document.querySelectorAll(".search-confirm-btn").forEach((button) => {
        button.addEventListener("click", (event) => {

          //   if (confirm("Are you really want to confirm the Employee")) {
          parentRow = event.currentTarget.closest("tr");
          projectname = parentRow.querySelector("#projectName").textContent;
          agentname = parentRow.querySelector("#agentName").textContent;
          projectskill=parentRow.querySelector('#projectskill').value;
          skillname = parentRow.querySelector("#skillName").value;
          if (projectname != "-------" && agentname != "-------") {
            if (confirm("Are you really want to confirm the Employee")) {
              // console.log(event.target.dataset.userEmail);
              confirmSoftlockUser(event.target.dataset.userEmail, projectname,projectskill);
            }
          } else {
            showConfirmModal(event.currentTarget.dataset.userEmail,skillname);

          }
        });
      });
    });
  // .catch(error => {
  //     console.error('There has been a problem with your fetch operation:', error);
  // });
}
function fetchProjectNames() {
  return fetch("fetch/fetch_get_project.php")
    .then((response) => response.json())
    .then((data) => {
      return data.projects;
    });
}
function fetchSkillNames(projectid) {
  // console.log(projectid);
  return fetch("fetch/fetch_get_skills.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      projectid: projectid,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      return data.skills;
    });
}
function fetchProjectDates(projectid) {
  return fetch("fetch/fetch_project_date.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      projectid: projectid,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      // console.log(data.StartDate);
      return [data.StartDate,data.EndDate];
    });
}

function showConfirmModal(UserId,skillname) {
  const modal = document.getElementById("project-confirm-modal");
  const projectDropdown = document.getElementById("confirmprojectDropdown");
  const confirmBtn = document.getElementById("confirm-project-button");
  const skillDropdown = document.getElementById("confirmSkillDropdown");
  const employeeStartDate = document.getElementById("employeeStartDateConfirm");
  const employeeEndDate = document.getElementById("employeeEndDateConfirm");

  fetchProjectNames().then((projects) => {
    projectDropdown.innerHTML = '<option value="">Select Project</option>';
    // console.log(projects);
    projects.forEach((project) => {
      const option = document.createElement("option");
      option.className = "smallModalDropdownOption";
      option.value = project.ProjectId;
      option.textContent = project.ProjectName;


      projectDropdown.appendChild(option);
    });
    // console.log(projectDropdown);
  });
  projectDropdown.addEventListener("change", (event) => {
    // console.log(projectDropdown.value)
    projectid = projectDropdown.value;
    if (projectid) {
      fetchSkillNames(projectid).then((skills) => {
        skillDropdown.innerHTML = "";
        // console.log(projects);
        skills.forEach((skill) => {
          const option = document.createElement("option");
          option.className = "smallModalDropdownOption";
          option.value = skill.SkillId;
          option.textContent = skill.SkillName;

          skillDropdown.appendChild(option);
        });
        // console.log(skillDropdown);
      });
  
      let project_date;
      fetchProjectDates(projectid).then((date) => {
        project_date=date;
      });
      
      setTimeout(()=>{
        projectStartDate=project_date[0];
        projectEndDate=project_date[1];
        // console.log(projectStartDate,projectEndDate);
      },1000);
    }
    
  });

  employeeStartDate.addEventListener("change", (event) => {
    employeeStartDateValue = employeeStartDate.value;
    const firstDate = new Date(employeeStartDateValue)
    const secondDate = new Date(projectStartDate)
    if(firstDate < secondDate){
      alert('you cannot select employee start date before project start date')
      employeeStartDate.value='';
      employeeStartDate.dispatchEvent(new Event('input'));
    }
  });
  employeeEndDate.addEventListener("change", (event) => {
    employeeEndDateValue = employeeEndDate.value;
    const thirdDate = new Date(employeeEndDateValue)
    const fourthDate = new Date(projectEndDate)
    if(thirdDate > fourthDate){
      alert('you cannot select employee end date after project end date')
      employeeEndDate.value='';
      employeeEndDate.dispatchEvent(new Event('input'));
    }
  });




  modal.style.display = "block";

  confirmBtn.onclick = () => {
    const projectId = projectDropdown.value;
    const skillDropdownName = skillDropdown.value;
    // console.log(projectId);
    // console.log(skillname);
    if (skillDropdownName !== skillname) {
      if (confirm("The required skill and the employee's primary skill does not match....Are you really want to proceed")){
          confirmUser(UserId, projectId,skillDropdownName,employeeStartDateValue,employeeEndDateValue);

      }

    }
    else{
        confirmUser(UserId, projectId,skillDropdownName,employeeStartDateValue,employeeEndDateValue);
    }

    
    modal.style.display = "none";
  };
}

function showSoftlockModal(UserId, skillname) {
  const modal = document.getElementById("project-softlock-modal");
  const projectDropdown = document.getElementById("softlockprojectDropdown");
  const softlockBtn = document.getElementById("softlock-project-button");
  const skillDropdown = document.getElementById("softlockSkillDropdown");
  const employeeStartDate = document.getElementById("employeeStartDate");
  const employeeEndDate = document.getElementById("employeeEndDate");

  fetchProjectNames().then((projects) => {
    projectDropdown.innerHTML = '<option value="">Select Project</option>';
    // console.log(projects);
    projects.forEach((project) => {
      const option = document.createElement("option");
      option.className = "smallModalDropdownOption";
      option.value = project.ProjectId;
      option.textContent = project.ProjectName;

      projectDropdown.appendChild(option);
    });
    // console.log(projectDropdown);
  });


  projectDropdown.addEventListener("change", (event) => {
    // console.log(projectDropdown.value)
    projectid = projectDropdown.value;
    if (projectid) {
      fetchSkillNames(projectid).then((skills) => {
        skillDropdown.innerHTML = "";
        // console.log(projects);

        skills.forEach((skill) => {
          const option = document.createElement("option");
          option.className = "smallModalDropdownOption";
          option.value = skill.SkillId;
          option.textContent = skill.SkillName;

          skillDropdown.appendChild(option);
        });
        // console.log(skillDropdown);
      });
  
      let project_date;
      fetchProjectDates(projectid).then((date) => {
        project_date=date;
      });
      
      setTimeout(()=>{
        projectStartDate=project_date[0];
        projectEndDate=project_date[1];
        // console.log(projectStartDate,projectEndDate);
      },1000);
    }
    
  });

  employeeStartDate.addEventListener("change", (event) => {
    employeeStartDateValue = employeeStartDate.value;
    const firstDate = new Date(employeeStartDateValue)
    const secondDate = new Date(projectStartDate)
    if(firstDate < secondDate){
      alert('you cannot select employee start date before project start date')
      employeeStartDate.value='';
      employeeStartDate.dispatchEvent(new Event('input'));
    }
  });
  employeeEndDate.addEventListener("change", (event) => {
    employeeEndDateValue = employeeEndDate.value;
    const thirdDate = new Date(employeeEndDateValue)
    const fourthDate = new Date(projectEndDate)
    if(thirdDate > fourthDate){
      alert('you cannot select employee end date after project end date')
      employeeEndDate.value='';
      employeeEndDate.dispatchEvent(new Event('input'));
    }
  });



  modal.style.display = "block";

  softlockBtn.onclick = () => {
    const projectId = projectDropdown.value;
    const skillDropdownName = skillDropdown.value;
    // console.log(skillDropdownName);
    // console.log(skillname);
    if (skillDropdownName !== skillname) {
      // console.log("Hello");
      if (confirm("The required skill and the employee's primary skill does not match....Are you really want to proceed")){
        softlockUser(UserId, projectId,skillDropdownName,employeeStartDateValue,employeeEndDateValue);
      }
    }
    else{
      softlockUser(UserId, projectId,skillDropdownName,employeeStartDateValue,employeeEndDateValue);
    }

    modal.style.display = "none";
  };
}

function softlockUser(UserId, projectId,skillId,startDate,endDate) {
  const AgentId = getcookie("AgentId");
  // const AgentId =2;
  fetch("fetch/fetch_save_softlock.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      UserId: UserId,
      AgentId: AgentId,
      projectId: projectId,
      skillId: skillId,
      startDate: startDate,
      endDate: endDate,
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
        showNotification("Successfully Softlocked");

        const userElement = document.querySelector(`tr[id="row${UserId}"]`);
        // console.log(userElement);

        //change the class and text of softlock button
        const softlockBtn = userElement.querySelector("#search-softlock-btn");

        softlockBtn.disabled = true;

        const softlockImage = userElement.querySelector(".search_user_status");
        softlockImage.src = "../images/softlock.svg";


        const agentname = userElement.querySelector("#agentName");
        agentname.textContent = data.agentname;

        const projectname = userElement.querySelector("#projectName");
        projectname.textContent = data.projectname;

        const skillid = userElement.querySelector("#projectskill");
        skillid.value = data.skillId;
      } else {
        showNotification("Error: " + data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Error: " + error.message, "error");
    });
}

function confirmUser(UserId, projectId,skillId,startDate,endDate) {
  const AgentId = getcookie("AgentId");
  // const AgentId=2;

  fetch("fetch/fetch_save_confirmation.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      UserId: UserId,
      AgentId: AgentId,
      projectId: projectId,
      skillId: skillId,
      startDate: startDate,
      endDate: endDate,
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

        const userElement = document.querySelector(`tr[id="row${UserId}"]`);
        // console.log(userElement);

        //set to disable confirm button
        const confirmBtn = userElement.querySelector(".search-confirm-btn");
        confirmBtn.disabled = true;
        const confirmImage = userElement.querySelector(".search_user_status");
        confirmImage.src = "../images/confirm.svg";

        const softlockBtn = userElement.querySelector("#search-softlock-btn");
        softlockBtn.disabled = true;

        const agentname = userElement.querySelector("#agentName");
        agentname.textContent = data.agentname;

        const projectname = userElement.querySelector("#projectName");
        projectname.textContent = data.projectname;
      } else {
        showNotification("Error: " + data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Error: " + error.message, "error");
    });
}


function confirmSoftlockUser(UserId,projectname,projectskill) {
  // console.log("confirmDashboardUser called");
  if (UserId != null) {
    const AgentId = getcookie("AgentId");

    // const AgentId = 2;

    fetch("fetch/fetch_save_softlock_confirmation.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        UserId: UserId,
        AgentId: AgentId,

        projectname:projectname,
        projectskill:projectskill

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
          const confirmBtn = userElement.querySelector(".search-confirm-btn");
          confirmBtn.disabled = true;

          const confirmImage = userElement.querySelector(".search_user_status");
          confirmImage.src = "../images/confirm.svg";

        } else {
          showNotification("Error: " + data.message, "error");
        }
      })
      .catch((error) => {
        showNotification("Error: " + error.message, "error");
      });
  }
}
