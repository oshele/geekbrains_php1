<hr>
<form enctype="multipart/form-data" method = "POST">
    <div>    
        Name: <input type="text" name="name" value="{{NAME}}">
    </div>
    <div>    
        Description: <textarea name="description" cols="30" rows="10">{{DESCRIPTION}}</textarea>
    </div>
    <div>    
        Price: <input type="number" name="price" value="{{PRICE}}">
    </div>
    <div>    
        Image: <input name="image" type="file" />
    </div>
    <div>    
        <input type="submit">
    </div>
</form>