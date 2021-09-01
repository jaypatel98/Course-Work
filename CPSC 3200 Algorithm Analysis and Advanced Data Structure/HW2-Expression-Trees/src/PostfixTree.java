import java.util.Stack;
public class PostfixTree {
    private Stack<Node> myData = new Stack();

    public void pushNumber(double d) {
        myData.push(new Node(d));
    }

    public void pushAdd() {
        Node rightChild = myData.pop();
        Node leftChild = myData.pop();
        myData.push(new Node("+", leftChild, rightChild));
    }

    public void pushMultiply() {
        Node rightChild = myData.pop();
        Node leftChild = myData.pop();
        myData.push(new Node("*", leftChild, rightChild));
    }

    public void pushSubtract() {
        Node rightChild = myData.pop();
        Node leftChild = myData.pop();
        myData.push(new Node("−", leftChild, rightChild));
    }

    public void pushDivide() {
        Node rightChild = myData.pop();
        Node leftChild = myData.pop();
        myData.push(new Node("/", leftChild, rightChild));
    }

    public String inorder() {
        Node tempNode = myData.peek();
        return tempNode.getExpr();
    }

    public double evaluate() {
        Node tempNode = myData.peek();
        return tempNode.evaluateExpr();
    }

    public int height() {
        Node n = myData.peek();
        int leftSize = n.getLeftHeight();
        int rightSize = n.getRightHeight();
        if (leftSize > rightSize) {
            return leftSize;
        } else {
            return rightSize;
        }
    }
}