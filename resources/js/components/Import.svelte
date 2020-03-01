<script>
import {onMount} from 'svelte';
import {vList} from './stores.js'

/*TODO
*
* Buttonelement entfernen
* removeChild(child) child = buttons
*
*
*
*/



//let buttonAttr = ""; 
var videoList = [];
var videoPage = 1;
var p = 0;
var per_page = 0;
var total = 0;

onMount( () => {
	getVideos(videoPage);
});


async function getVideos(vp){
	console.log("VP: " , vp);
	const response = await axios(
     {
         url: '/admin/video/create/' +vp,
         method: 'GET'
     }
 )
  console.log("Response: " ,response);
  videoList = response.data.list;
  p = response.data.response.body.page;
  per_page = response.data.response.body.page;
  total = response.data.response.body.total;
  videoPage = vp;
  console.log(videoList); 
}


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
		videoList = video_list;
}

	// Video in der Datenbank speichern (importieren)
	async function handleClick(i){
		
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
					<div class="card-header">Import Video</div>

					<div class="card-body">
					{#if videoPage > 1}
					  <button class="btn btn-primary"  on:click|preventDefault={() => getVideos(videoPage -1)} >prev</button>
					{/if} 
					{#if videoPage * per_page < total}
					  <button class="btn btn-primary" on:click|preventDefault={() => getVideos(videoPage +1 )} >next</button>
					{/if}
					
						{#each videoList as item, i }
						<form >
						<input type="hidden" value="{i}" name="index" />
						<p>{item.name}</p>
						<img src={item.pictures.sizes[0].link} alt={item.name}/>
						<button  class="btn btn-primary" type="submit"
						on:click|preventDefault={() =>handleClick(i)}>Import</button>	
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