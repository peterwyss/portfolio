<script>
import {onMount} from 'svelte';
var video_list = [];


onMount( async function() {
 
 const response = await axios(
     {
         url: '/admin/video/edit',
         method: 'GET'
     }
 )
  console.log(response);
  video_list = response.data;
  console.log(video_list.length);      
})

async function saveChange(item){
    console.log(item);
		const response = await axios(
		{
			url: "/admin/video/update",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'id' : item.id,
				'name' : item.name,
				'description':	item.description,
				'position' : item.position,
				'page' : item.page,
			}
		});

}
async function deleteItem(item){
    console.log(item);
		const response = await axios(
		{
			url: "/admin/video/delete",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'id' : item.id,
				'name' : item.name,
				'description':	item.description,
				'position' : item.position,
				'page' : item.page,
			}
		});

}
</script>

<div>
{#each video_list as item, i}
<img src="{item.picture}" class="btn" alt="{item.name}" data-toggle="collapse" href="#collapseExample_{item.id}" role="button" aria-expanded="false" aria-controls="collapseExample"/>
<div class="collapse" id="collapseExample_{item.id}" >
<div class="card card-body">
<form >
<input type="text" bind:value="{item.name}" /> 
<input type="text" bind:value="{item.description}" />
<input type="number" bind:value="{item.position}" />
<input type="number" bind:value="{item.page}" /> 
<button class="btn btn-primary" on:click|preventDefault={() => saveChange(item)}>Save</button> 
<button class="btn btn-primary" on:click|preventDefault={() => deleteItem(item)}>Delete</button> 

</form>
</div>
</div>
{/each}
</div>