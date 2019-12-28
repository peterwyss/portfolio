<script>
/*TODO
*
* Videoliste im Store holen und speichern
* benötigt eine neue Funktion im VideoController
*
*
*
*
*/


import { tick } from 'svelte';

let buttonAttr = ""; 
	var videoList = video_list;

async function deleteItem(id){
	console.log(id);
	const response = await axios(
		{
			url: "/admin/video/delete",
			method: 'POST',
			params: {
				'id' : id,
			}
		});
	await tick();
	videoList = video_list;	

}


	async function handleClick(e){
		const i = e.target.index.value;
		console.log(videoList)
		videoList[i].exist.push(i);
		const response = await axios(
		{
			url: "/admin/video/store",
			method: 'POST',
			params: {
				'name' : videoList[i].name,
				'video_id': videoList[i].video_id,
				'description':	videoList[i].description,
				'visible' : "false",
				'position' : 0,
				'page' : 0,
				'picture': videoList[i].pictures.sizes[0].link,
				'exist' : videoList[i].exist,
			}
		});
		//const data = await response.json();
		console.log(response.data.database_id);

		var newElement = document.createElement('button');
		newElement.className = "btn btn-success";
		let text = document.createTextNode(response.data.database_id);
		newElement.appendChild(text);
		var insertElement = document.getElementById(response.data.video_id);
		insertElement.appendChild(newElement);
	};
</script>    

<main>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Example Component</div>
					<div class="card-body">
						I'm an example component.
						{#each videoList as item, i }
						<form on:submit|preventDefault={handleClick}>
						<input type="hidden" value="{i}" name="index" />
						<p>{item.name}</p>
						<img src={item.pictures.sizes[0].link} alt={item.name}/>
						<button  class="btn btn-primary" type="submit" >Import</button>	
						<div id={item.video_id}>
						{#if item.exist.length > 0}
						  {#each item.exist as itemExist}
						    <button id="{itemExist.id}"  class="btn btn-success" 
							on:click|preventDefault={() => deleteItem(itemExist.id)}>
							{itemExist.id}</button>
						  {/each}
						{/if}
						</div>
						</form>
						{/each}
					</div>
				</div>
			</div>
		</div>
	</div>
</main>