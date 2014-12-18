var viewDropDownSelectBoxesData = {};

function buildDropDownSelectBox(viewId,rebuild)
{	
	for(var p in viewDropDownSelectBoxesData)
	{
		for(var y in viewDropDownSelectBoxesData[p])
		{
			var mpDestSelectBox = document.getElementById(y);
			var i;
			var curValueRelationId = 0;
			for (i = mpDestSelectBox.length - 1; i>=0; i--)
			{
				if(mpDestSelectBox.options[i].value == '')
					continue;

                if(rebuild && mpDestSelectBox[i].selected && !curValueRelationId)
                {
                    curValueRelationId = viewDropDownSelectBoxesData[p][y][i][4];
                }
				mpDestSelectBox.remove(i);
			}

			for(var v in viewDropDownSelectBoxesData[p][y])
			{
				if($(".currentlanguage").val() && viewDropDownSelectBoxesData[p][y][v][3] != $(".currentlanguage").val())
				{
					continue;
				}
				var oOption = document.createElement("OPTION");
				oOption.value = viewDropDownSelectBoxesData[p][y][v][0];
				oOption.text  = viewDropDownSelectBoxesData[p][y][v][1];
				if( (viewDropDownSelectBoxesData[p][y][v][2] == 1 && !rebuild) || (viewDropDownSelectBoxesData[p][y][v][4] == curValueRelationId) )
					oOption.setAttribute('selected','selected');
				mpDestSelectBox.options.add(oOption);
			}
		}
	}
}