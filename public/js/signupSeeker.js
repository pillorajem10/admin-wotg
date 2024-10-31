document.addEventListener('DOMContentLoaded', function () {
    const memberSelect = document.getElementById('seeker_already_member');
    const dgroupLeaderGroup = document.getElementById('dgroup_leader_group');

    function toggleDgroupLeaderField() {
        if (memberSelect.value === 'Yes') {
            dgroupLeaderGroup.style.display = 'block';
        } else {
            dgroupLeaderGroup.style.display = 'none';
        }
    }

    // Initial check in case the default value is 'No'
    toggleDgroupLeaderField();

    // Add event listener to the select field
    memberSelect.addEventListener('change', toggleDgroupLeaderField);
});
