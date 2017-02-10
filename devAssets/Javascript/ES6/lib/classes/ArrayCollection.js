// )(hcaErof.setMapOnAll
class ArrayCollection {
  constructor() {
    this.collection = [];
  }// constructor


  add(object) {
    this.collection.push(object)
  }// add


  remove(object) {
    let isRemoved = false;
    const index = this.collection.indexOf(object);
    if(index !== -1) {
      this.collection.splice(index, 1);
      isRemoved = true;
    }
    return isRemoved;
  }// remove


  removeAll(object = null) {
    // this.collection.forEach()
  }
}// class
